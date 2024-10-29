<?php

namespace App\Livewire\Website\Shop;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

class Productdetails extends Component
{
    public $product;
    public $user_id;
    public $quantity = 1;
    public $size = null;
    public $color = null;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->user_id = auth()->id();
    }

    public function addToCart()
    {
        // If user is not logged in
        if (!$this->user_id) {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'Please login first.',
                'icon' => 'warning',
            ]);
            return; // Stop further execution if user is not logged in
        }

        // Check if size, color, and quantity are selected/valid
        if (empty($this->size) || empty($this->color) || empty($this->quantity) || $this->quantity <= 0) {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'Please select a valid size, color, and quantity.',
                'icon' => 'warning',
            ]);
            return;
        }

        // Create or retrieve the user's cart
        $cart = Cart::firstOrCreate(['user_id' => $this->user_id]);
        $inventory = Inventory::where('product_id', $this->product->id)->first();
        if ($inventory->stock == 0) {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'This product is out of stock.',
                'icon' => 'warning',
            ]);
            return;
        }
        if ($this->quantity > $inventory->stock) {
            $this->dispatch('swal:alert', [
                'title' => 'Insufficient Stock!',
                'text' => "Sorry, we only have {$inventory->stock} items available for this product. Please adjust your order quantity.",
                'icon' => 'error',
            ]);
            return;
        }
        // Check if the item already exists in the cart
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $this->product->id)
            ->where('size', $this->size)
            ->where('color', $this->color)
            ->first();

        if ($existingItem) {
            // Item already exists in cart
            $this->dispatch('swal:alert', [
                'title' => 'Item Already in Cart',
                'text' => 'This item with the selected size, color, and quantity is already in your cart.',
                'icon' => 'info',
            ]);
        } else {
            // Add the item to the cart
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'size' => $this->size,
                'color' => $this->color,
                'quantity' => $this->quantity,
            ]);

            $inventory->update([
                'stock' => $inventory->stock - $this->quantity,
            ]);

            // Success alert
            $this->dispatch('swal:alert', [
                'title' => 'Success!',
                'text' => 'Item added to your cart successfully.',
                'icon' => 'success',
            ]);
            $this->dispatch('refreshPage');
        }
    }

    public function addToFavorite()
    {
        // If user is not logged in
        if (!$this->user_id) {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'Please login first.',
                'icon' => 'warning',
            ]);
            return; // Stop further execution if user is not logged in
        }

        // Check if the item already exists in the favoritesssssss
        $existingItem = Favorite::where('user_id', $this->user_id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($existingItem) {
            // Item already exists in favorites
            $this->dispatch('swal:alert', [
                'title' => 'Item Already in Favorites',
                'text' => 'This item is already in your favorites.',
                'icon' => 'info',
            ]);
        } else {
            // Add the item to the favorites
            Favorite::create([
                'user_id' => $this->user_id,
                'product_id' => $this->product->id,
            ]);

            // Success alert
            $this->dispatch('swal:alert', [
                'title' => 'Success!',
                'text' => 'Item added to your favorites successfully.',
                'icon' => 'success',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.website.shop.productdetails')->layout('layout.website.app');
    }
}
