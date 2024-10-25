<?php

namespace App\Livewire\Website\Products;

use App\Models\Product;
use Livewire\Component;
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
        // Initialize user_id with the logged-in user's ID
        $this->user_id = Auth::id();

        $this->newArrivals = Product::orderBy('created_at', 'desc')
            ->take(7)
            ->get()
            ->map(function ($product) {
                $product->stars = $this->calculateStars($product->rating);
                $product->isFavorited = $this->checkIfInFavorite($product->id); // Check if the product is in favorites
                return $product;
            });

        $this->hotSales = Product::orderBy('price', 'desc')
            ->take(3)
            ->get()
            ->map(function ($product) {
                $product->stars = $this->calculateStars($product->rating);
                $product->isFavorited = $this->checkIfInFavorite($product->id); // Check if the product is in favorites
                return $product;
            });
    }

    private function checkIfInFavorite($productId)
    {
        // Check if the product is in the user's favorites
        return Favorite::where('user_id', $this->user_id)
            ->where('product_id', $productId)
            ->exists();
    }

    private function calculateStars($rating)
    {
        return round($rating); // Round the rating to the nearest whole number
    }

    public function addToFavorite($id)
    {
        // Ensure the user is authenticated
        if (!$this->user_id) {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'Please login first.',
                'icon' => 'warning',
            ]);
            return; // Stop further execution if user is not logged in
        }

        $this->product = Product::findOrFail($id);

        // Check if the product already exists in favorites
        $existingItem = Favorite::where('user_id', $this->user_id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($existingItem) {
            // Item is already in favorites
            $this->dispatch('swal:alert', [
                'title' => 'Item Already in Favorites',
                'text' => 'This item is already in your favorites.',
                'icon' => 'info',
            ]);
        } else {
            // Add the item to favorites
            Favorite::create([
                'user_id' => $this->user_id,
                'product_id' => $this->product->id,
            ]);

            // Success alert
            $this->dispatch('swal:alert', [
                'title' => 'Success!',
                'text' => 'Item added to your favorites successfully..',
                'icon' => 'success',
            ]);

            $this->dispatch('refreshPage');
        }
    }

    public function render()
    {
        return view('livewire.website.products.products')->layout('layout.website.app');
    }
}
