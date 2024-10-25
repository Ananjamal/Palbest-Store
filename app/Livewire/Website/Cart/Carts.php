<?php

namespace App\Livewire\Website\Cart;

use App\Models\Cart;
use App\Models\Coupon;
use Livewire\Component;
use App\Models\CartItem;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Carts extends Component
{
    public $user_id;
    public $totalPrice = 0;
    public $subTotal = 0;
    public $cartItems = [];
    public $quantity;
    public $item_id;
    public $coupon_code;
    public $discount = 0;

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->cart = Cart::where('user_id', $this->user_id)->first();

        if ($this->cart) {
            $this->cartItems = CartItem::where('cart_id', $this->cart->id)->get();
            $this->calculateTotalPrice();
        }
    }

    public function increaseQty($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->update([
            'quantity' => ++$cartItem->quantity,
        ]);
        $this->mount();
    }
    public function decreaseQty($id)
    {
        $cartItem = CartItem::findOrFail($id);
        if ($cartItem->quantity > 1) {
            $cartItem->update([
                'quantity' => --$cartItem->quantity,
            ]);
            $this->mount();
        }
    }
    public function deleteFromCart($id)
    {
        CartItem::destroy($id);
        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Item deleted from your cart successfully.',
            'icon' => 'success',
        ]);
        $this->mount();
        $this->dispatch('refreshPage');
    }
    public function applyCoupon()
    {
        if (empty($this->cartItems)) {
            $this->dispatch('swal:alert', [
                'title' => 'Error!',
                'text' => 'Please add some items to your cart first.',
                'icon' => 'error',
            ]);
            return;
        }
        $couponCode = Coupon::where('code', $this->coupon_code)->first();

        if ($couponCode) {
            $this->discount = $couponCode->discount_amount;
            $this->dispatch('swal:alert', [
                'title' => 'Success!',
                'text' => 'Coupon applied successfully.',
                'icon' => 'success',
            ]);
            $this->mount(); // Ensure total price is recalculated after discount
        } else {
            // Optionally, you can dispatch an alert for an invalid coupon
            $this->discount = 0;
            $this->dispatch('swal:alert', [
                'title' => 'Error!',
                'text' => 'Invalid coupon code.',
                'icon' => 'error',
            ]);
        }
    }

    public function calculateTotalPrice()
    {
        $this->subTotal = $this->cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $this->totalPrice = $this->subTotal - $this->discount;
    }
    #[On('refreshPage')]
    public function refresh()
    {
        $this->item_id = null;
    }
    public function sendDataToCheckout()
{
    $data = [
        'cartItems' => $this->cartItems,
        'subTotal' => $this->subTotal,
        'discount' => $this->discount,
        'totalPrice' => $this->totalPrice,
    ];

    session()->put('checkout_data', $data);

    return redirect()->route('checkout');
}



    public function render()
    {
        return view('livewire.website.cart.carts', [
            'cartItems' => $this->cartItems,
        ])->layout('layout.website.app');
    }
}
