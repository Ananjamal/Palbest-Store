<?php

namespace App\Livewire\Website\Products;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    public $product;
    public $user_id;
    public $newArrivals;
    public $hotSales;

    public function mount()
    {
        $this->user_id = Auth::id();

        $this->newArrivals = Product::orderBy('created_at', 'desc')
            ->take(6)
            ->get()
            ->map(function ($product) {
                $product->stars = $this->calculateStars($product->rating);
                $product->isFavorited = $this->checkIfInFavorite($product->id); // Check if the product is in favorites
                return $product;
            });

        $newArrivalIds = $this->newArrivals->pluck('id')->toArray();

        $this->hotSales = Product::whereNotIn('id', $newArrivalIds)
            ->take(4)
            ->get()
            ->map(function ($product) {
                $product->stars = $this->calculateStars($product->rating);
                $product->isFavorited = $this->checkIfInFavorite($product->id);
                return $product;
            });
    }

    private function checkIfInFavorite($productId)
    {
        return Favorite::where('user_id', $this->user_id)
            ->where('product_id', $productId)
            ->exists();
    }

    private function calculateStars($rating)
    {
        return round($rating);
    }

    public function addToFavorite($id)
    {
        if (!$this->user_id) {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'Please login first.',
                'icon' => 'warning',
            ]);
            return;
        }

        $this->product = Product::findOrFail($id);

        $existingItem = Favorite::where('user_id', $this->user_id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($existingItem) {
            $this->dispatch('swal:alert', [
                'title' => 'Item Already in Favorites',
                'text' => 'This item is already in your favorites.',
                'icon' => 'info',
            ]);
        } else {
            Favorite::create([
                'user_id' => $this->user_id,
                'product_id' => $this->product->id,
            ]);

            $this->dispatch('swal:alert', [
                'title' => 'Success!',
                'text' => 'Item added to your favorites successfully..',
                'icon' => 'success',
            ]);
            $this->mount();
            $this->dispatch('refreshPage');
        }
    }

    public function addToCart($id)
    {
        $this->product = Product::findOrFail($id);

        // Create or retrieve the user's cart
        $cart = Cart::firstOrCreate(['user_id' => $this->user_id]);

        // Check if the item already exists in the cart
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($existingItem) {
            // Item already exists in cart
            $this->dispatch('swal:alert', [
                'title' => 'Item Already in Cart',
                'text' => 'This item is already in your cart.',
                'icon' => 'info',
            ]);
        } else {
            // Add the item to the cart
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,

            ]);

            // Success alert
            $this->dispatch('swal:alert', [
                'title' => 'Success!',
                'text' => 'Item added to your cart successfully.',
                'icon' => 'success',
            ]);
            $this->mount();

            $this->dispatch('refreshPage');
        }
    }
    public function render()
    {
        return view('livewire.website.products.products')->layout('layout.website.app');
    }
}
