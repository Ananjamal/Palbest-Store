<?php
namespace App\Livewire\Website\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Livewire\Attributes\On;
use App\Models\ShippingDetail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $cartItems = [];
    public $subTotal = 0;
    public $discount = 0;
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
    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|regex:/^[0-9]{10,15}$/', // 10 to 15 digits
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:500',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'zip_code' => 'required|regex:/^[0-9]{3}(-[0-9]{4})?$/', // 5 or 9 digit zip codes
        'payment_method' => 'required|in:check,paypal,visacard', // Ensures the value is one of the allowed payment methods
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount()
    {
        $this->user_id = Auth::id();

        if (session()->has('checkout_data')) {
            $checkoutData = session()->get('checkout_data');
            $this->cartItems = $checkoutData['cartItems'];
            $this->subTotal = $checkoutData['subTotal'];
            $this->discount = $checkoutData['discount'];
            $this->totalPrice = $checkoutData['totalPrice'];
        }
    }
    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => $this->user_id,
            'total_amount' => $this->totalPrice,
            'discount' => $this->discount,
            'payment_method' => $this->payment_method,
        ]);
        
        foreach ($this->cartItems as $cart) {
            $orderItems = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product->id,
                'quantity' => $cart->quantity,
                'size' => $cart->size,
                'color' => $cart->color,
            ]);
        }
        $ShippingDetails = ShippingDetail::create([
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

        sleep(5);
        return redirect()->route('/');
    }
    public function render()
    {
        return view('livewire.website.checkout.checkout')->layout('layout.website.app');
    }
}
