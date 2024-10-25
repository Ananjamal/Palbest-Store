<?php

namespace App\Livewire\Website\Favorite;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class Favorites extends Component
{
    public $user_id;
    public $favoriteItems;
    public function mount()
    {
        $this->user_id = Auth::id();
        $this->favoriteItems = Favorite::where('user_id', $this->user_id)->get();
    }

    public function removeFromWishlist($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();
        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Item deleted from your wishlist successfully.',
            'icon' => 'success',
        ]);
        $this->mount();
        $this->dispatch('refreshPage');
    }

    // public function moveToCart($id)
    // {
    //     $this->product = Product::findOrFail($id);

    //     // Create or retrieve the user's cart
    //     $cart = Cart::firstOrCreate(['user_id' => $this->user_id]);

    //     // Check if the item already exists in the cart
    //     $existingItem = CartItem::where('cart_id', $cart->id)
    //         ->where('product_id', $this->product->id)
    //         ->first();

    //     if ($existingItem) {
    //         // Item already exists in cart
    //         $this->dispatch('swal:alert', [
    //             'title' => 'Item Already in Cart',
    //             'text' => 'This item is already in your cart.',
    //             'icon' => 'info',
    //         ]);
    //     } else {
    //         // Add the item to the cart
    //         CartItem::create([
    //             'cart_id' => $cart->id,
    //             'product_id' => $this->product->id,

    //         ]);

    //         // Success alert
    //         $this->dispatch('swal:alert', [
    //             'title' => 'Success!',
    //             'text' => 'Item added to your cart successfully.',
    //             'icon' => 'success',
    //         ]);
    //         $this->dispatch('refreshPage');
    //     }
    // }
    public function render()
    {
        return view('livewire.website.favorite.favorites')->layout('layout.website.app');
    }
}
