<?php

namespace App\Livewire\Website\Cart;

use App\Models\Cart;
use App\Models\Coupon;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Inventory;
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
    public $discount_amount = 0;
    public $discountPercentage = 0;

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
        $inventoryCheck = Inventory::where('product_id', $cartItem->product_id)->first();

        // Check if there is enough stock available
        if ($inventoryCheck->stock !== 0) {
            // Increase cart item quantity and decrease inventory stock
            $cartItem->increment('quantity'); // This increments the quantity by 1
            $inventoryCheck->decrement('stock'); // Decrease stock by 1
            $this->mount(); // Refresh the cart data
        } else {
            // Notify user if not enough stock
            $this->dispatch('swal:alert', [
                'title' => 'Error!',
                'text' => 'Not enough stock available.',
                'icon' => 'error',
            ]);
        }
    }

    public function decreaseQty($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->quantity > 1) {
            $inventoryCheck = Inventory::where('product_id', $cartItem->product_id)->first();

            if ($inventoryCheck) {
                $cartItem->decrement('quantity');
                $inventoryCheck->increment('stock');
                $this->mount(); 
            }
        } else {
            $this->dispatch('swal:alert', [
                'title' => 'Notice',
                'text' => 'Cannot decrease quantity below 1. Consider deleting the item if you wish to remove it from the cart.',
                'icon' => 'info',
            ]);
        }
    }

    public function deleteFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $inventoryCheck = Inventory::where('product_id', $cartItem->product_id)->first();
        $inventoryCheck->update(['stock' => $inventoryCheck->stock + $cartItem->quantity]);
        $cartItem->delete();
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
            $this->discount_amount = $couponCode->discount_amount;
            $this->discountPercentage = ($this->subTotal * $couponCode->discount_amount) / 100;
            $this->dispatch('swal:alert', [
                'title' => 'Success!',
                'text' => 'Coupon applied successfully.',
                'icon' => 'success',
            ]);
            $this->mount(); // Ensure total price is recalculated after discount
        } else {
            // Optionally, you can dispatch an alert for an invalid coupon
            $this->discount_amount = 0;
            $this->discountPercentage = 0;
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
        $this->totalPrice = $this->subTotal - $this->discountPercentage;
    }
    #[On('refreshPage')]
    public function refresh()
    {
        $this->item_id = null;
    }
    public function sendDataToCheckout()
    {
        if (empty($this->cartItems)) {
            $this->dispatch('swal:alert', [
                'title' => 'Error!',
                'text' => 'Please add some items to your cart first.',
                'icon' => 'error',
            ]);
            return;
        }
        $data = [
            'cartItems' => $this->cartItems,
            'subTotal' => $this->subTotal,
            'discount_amount' => $this->discount_amount,
            'discountPercentage' => $this->discountPercentage,
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
