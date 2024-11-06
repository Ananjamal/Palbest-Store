<?php
namespace App\Livewire\Website\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use App\Models\ShippingDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Charge;

class Checkout extends Component
{
    protected $listeners = ['setToken', 'processPayment'];

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
        'payment_method' => 'required|in:check,paypal,creditcard',
    ];

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->paid = session('payment_status', false);

        if (session()->has('checkout_data')) {
            $checkoutData = session()->get('checkout_data');
            $this->cartItems = $checkoutData['cartItems'];
            $this->subTotal = $checkoutData['subTotal'];
            $this->discount_amount = $checkoutData['discount_amount'];
            $this->discountPercentage = $checkoutData['discountPercentage'];
            $this->totalPrice = $checkoutData['totalPrice'];
        }
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function placeOrder()
    {
        if(!$this->paid) {
            $this->dispatch('swal:alert', [
                'title' => 'Pending Payment',
                'text' => 'Please complete the payment to proceed with your order.',
                'icon' => 'info',
            ]);
            return;
        }
        
        $this->validate($this->rules);
        $this->method_check = $this->payment_method;

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
        session()->forget('payment_status');

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

            $order = Order::where('user_id', $this->user_id)->first();
            $order_id = $order->id; // Get the order ID
            // Get last 4 digits of the card number from the token (or previously stored)
            $cardLast4 = $this->getLast4Digits($this->token);

            // Check if a charge with the same amount, description, and card last 4 digits exists
            foreach ($existingCharges->data as $existingCharge) {
                if ($existingCharge->amount === $this->totalPrice * 100 && $existingCharge->description === 'Payment for order #' . $order_id && $existingCharge->payment_method_details->card->last4 === $cardLast4) {
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
                'description' => 'Payment for order #' . $order_id, // Use $order_id here
            ]);

            if ($charge->status === 'succeeded') {
                session(['payment_status' => true]); // Store payment status in session
                $this->method_check = $this->payment_method; // Update method_check after success

                $this->dispatch('swal:alert', [
                    'title' => 'Success!',
                    'text' => 'Payment processed successfully.',
                    'icon' => 'success',
                ]);
                $this->render();
                // return redirect()->route('checkout');

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
