<?php

namespace App\Livewire\Website\Menu;

use App\Models\Cart;
use Livewire\Component;
use App\Models\CartItem;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class Begin extends Component
{
    public $cartCount;
    public $cartItems;
    public $cart;
    public $user_id;
    #[On('refreshPage')]
    public function mount()
    {
        $this->user_id = Auth::id();
        $this->cart = Cart::where('user_id', $this->user_id)->first();

        if ($this->cart) {
            $this->cartItems = CartItem::where('cart_id', $this->cart->id)->get();
            $this->cartCount = $this->cartItems->count();
        }
    }
    public function render()
    {
        return view('livewire.website.menu.begin')->layout('layout.website.app');
    }
}
