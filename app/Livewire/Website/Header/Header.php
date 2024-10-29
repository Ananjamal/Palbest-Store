<?php

namespace App\Livewire\Website\Header;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Favorite;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Header extends Component
{
    public $favorites;
    public $favoriteCount;
    public $cartCount;
    public $cartItems;
    public $cart;
    public $user_id;
    public $cartItemsCount;
    public $cartItemsTotal;
    public $cartItemsSubTotal;
    public $ordersCount;

    #[On('refreshPage')]
    public function mount()
    {
        $this->user_id = Auth::id();
        $this->cart = Cart::where('user_id', $this->user_id)->first();
        $this->favorites = Favorite::where('user_id', $this->user_id)->get();
        $this->favoriteCount = $this->favorites->count();

        $this->orders = Order::where('user_id', $this->user_id)->get();
        $this->ordersCount = $this->orders->count();
        if ($this->cart) {
            $this->cartItems = CartItem::where('cart_id', $this->cart->id)->get();
            $this->cartCount = $this->cartItems->count();
        } else {
            $this->cartCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.website.header.header')->layout('layout.website.app');
    }
}
