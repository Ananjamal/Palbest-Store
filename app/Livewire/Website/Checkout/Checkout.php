<?php
namespace App\Livewire\Website\Checkout;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;
use App\Models\OrderItem;
use App\Models\ShippingDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    protected $listeners = ['setToken', 'processPayment'];
    public $isSaved = false; // Add this property

    public $cartItems = [];
    public $subTotal = 0;
    public $discount_amount = 0;
    public $discountPercentage = 0;
    public $totalPrice = 0;
    public $user_id;
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $state;
    public $country;
    public $zip_code;
    public $payment_method;
    public $paid = false;
    public $method_check;
    public $token; // Token set from the frontend
    public $order_id;
    public $payment_type;
    public $username;

    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|regex:/^[0-9]{6,15}$/',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:500',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'zip_code' => 'required|regex:/^[0-9]{3,6}$/',
        // 'payment_method' => 'required|in:check,paypal,creditcard',
    ];

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->username = Auth::user()->name;
        $this->paid = session('payment_status', false);
        $this->payment_method = session('payment_type');
        if (session()->has('checkout_form_data')) {
            $formData = session('checkout_form_data');
            $this->first_name = $formData['first_name'];
            $this->last_name = $formData['last_name'];
            $this->phone = $formData['phone'];
            $this->email = $formData['email'];
            $this->address = $formData['address'];
            $this->city = $formData['city'];
            $this->state = $formData['state'];
            $this->country = $formData['country'];
            $this->zip_code = $formData['zip_code'];
            $this->isSaved = true; // Enable payment methods if data already exists in the session
        }

        if (session()->has('checkout_data')) {
            $checkoutData = session()->get('checkout_data');
            $this->cartItems = $checkoutData['cartItems'];
            $this->subTotal = $checkoutData['subTotal'];
            $this->discount_amount = $checkoutData['discount_amount'];
            $this->discountPercentage = $checkoutData['discountPercentage'];
            $this->totalPrice = $checkoutData['totalPrice'];
        }
    }
    public function saveCheckoutData()
    {
        // Validate fields before saving to session
        $this->validate();

        // Save data to session
        session([
            'checkout_form_data' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone' => $this->phone,
                'email' => $this->email,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'zip_code' => $this->zip_code,
            ],
        ]);
        $this->isSaved = true; // Set to true to enable payment section

        session()->flash('message', 'Checkout information saved successfully!');
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function placeOrder()
    {
        if($this->payment_method !== 'check'){
            if (!$this->paid) {
                $this->dispatch('swal:alert', [
                    'title' => 'Pending Payment',
                    'text' => 'Please complete the payment to proceed with your order.',
                    'icon' => 'info',
                ]);
                return;
            }
        }
        $this->validate($this->rules);

        $order = Order::create([
            'user_id' => $this->user_id,
            'total_amount' => $this->totalPrice,
            'discount' => $this->discount_amount,
            'payment_method' => $this->payment_method,
        ]);
        foreach ($this->cartItems as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'size' => $cart->size,
                'color' => $cart->color,
            ]);
        }
        $this->order_id = $order->id;
        
        if ($this->payment_method == 'check') {
            $payment_status = 'un-paid';
        } else {
            $payment_status = 'paid';
        }
        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => $this->totalPrice,
            'method' => $this->payment_method,
            'status' => $payment_status,
        ]);
        ShippingDetail::create([
            'order_id' => $order->id,
            'shipping_first_name' => $this->first_name,
            'shipping_email' => $this->email,
            'shipping_last_name' => $this->last_name,
            'shipping_phone' => $this->phone,
            'shipping_address' => $this->address,
            'shipping_city' => $this->city,
            'shipping_state' => $this->state,
            'shipping_country' => $this->country,
            'shipping_zip' => $this->zip_code,
        ]);

        $this->reset(['first_name', 'last_name', 'phone', 'address', 'city', 'state', 'country', 'zip_code', 'payment_method']);
        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Order Placed Successfully.',
            'icon' => 'success',
        ]);

        Cart::where('user_id', $this->user_id)->delete();
        session()->forget(['payment_status', 'payment_type', 'checkout_form_data', 'checkout_data']);

        return redirect()->route('/');
    }

    public function setPaymentMethod()
    {
        $this->method_check = $this->payment_method; // Assigning payment_method to method_check
    }

    public function processPayment()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Retrieve existing charges to check if a similar charge exists
            $existingCharges = Charge::all([
                'limit' => 100, // Adjust the limit as needed
                'currency' => 'usd',
            ]);

            // Get the order ID
            // Get last 4 digits of the card number from the token (or previously stored)
            $cardLast4 = $this->getLast4Digits($this->token);

            // Check if a charge with the same amount, description, and card last 4 digits exists
            foreach ($existingCharges->data as $existingCharge) {
                if ($existingCharge->amount === $this->totalPrice * 100 && ($existingCharge->description === 'Payment for order #' . $existingCharge->payment_method_details->card->last4) === $cardLast4) {
                    $this->dispatch('swal:alert', [
                        'title' => 'Info!',
                        'text' => 'A similar charge already exists for this card.',
                        'icon' => 'info',
                    ]);
                    return; // Exit if the charge already exists
                }
            }

            // Create a Charge using the token securely sent from the frontend
            $charge = Charge::create([
                'amount' => $this->totalPrice * 100, // Convert dollars to cents
                'currency' => 'usd',
                'source' => $this->token,
                'description' => 'Payment for username: ' . $this->username, // Use $order_id here
            ]);

            if ($charge->status === 'succeeded') {
                session(['payment_status' => true]); // Store payment status in session

                session(['payment_type' => $this->payment_method]); // Store payment status in session

                $this->dispatch('swal:alert', [
                    'title' => 'Success!',
                    'text' => 'Payment processed successfully.',
                    'icon' => 'success',
                ]);
                return redirect()->route('checkout');
            } else {
                throw new \Exception('Payment not successful. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Payment error: ' . $e->getMessage());
            $this->dispatch('swal:alert', [
                'title' => 'Error!',
                'text' => 'An error occurred: ' . $e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
    // Helper function to retrieve last 4 digits of the card
    protected function getLast4Digits($token)
    {
        // Use the Stripe API or saved card data to get last 4 digits
        $cardDetails = \Stripe\Token::retrieve($token);
        return $cardDetails->card->last4;
    }

    public function render()
    {
        return view('livewire.website.checkout.checkout')->layout('layout.website.app');
    }
}
