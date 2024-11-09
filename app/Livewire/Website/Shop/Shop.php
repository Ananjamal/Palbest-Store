<?php

namespace App\Livewire\Website\Shop;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Inventory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Shop extends Component
{
    public $products;
    public $user_id;
    public $product;
    public $quantity = 1;
    public $searchTerm = '';
    public $selectedCategory;
    public $selectedSize;  // Store single size
    public $selectedColor; // Store single color
    public $selectedPriceRange;
    public $categories = [];
    public $sizes = ['S', 'M', 'XL', 'L'];
    public $colors = ['Red', 'Blue', 'Green', 'Black'];

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->categories = Category::withCount('products')->get();
        $this->loadProducts();
    }

    public function loadProducts()
    {
        // Start the query
        $query = Product::with('reviews');

        // Apply search term filter if present
        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }

        // Apply category filter if present
        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        // Apply filters, ensuring only one is active at a time
        if ($this->selectedPriceRange) {
            $this->resetFilters('price');
            $this->applyPriceRangeFilter($query);
        } elseif ($this->selectedSize) {
            $this->resetFilters('size');
            $query->whereJsonContains('size', $this->selectedSize);
        } elseif ($this->selectedColor) {
            $this->resetFilters('color');
            $query->whereJsonContains('color', $this->selectedColor);
        }

        // Get products and add stars and favorites
        $this->products = $query->get()->map(function ($product) {
            $product->stars = $this->calculateStars($product->reviews);
            $product->isFavorited = $this->checkIfInFavorite($product->id);
            return $product;
        });
    }

    private function applyPriceRangeFilter($query)
    {
        if ($this->selectedPriceRange === '0-50') {
            $query->whereBetween('price', [0, 50])->orderBy('price', 'asc');
        } elseif ($this->selectedPriceRange === '50-100') {
            $query->whereBetween('price', [50, 100])->orderBy('price', 'asc');
        } elseif ($this->selectedPriceRange === '100-150') {
            $query->whereBetween('price', [100, 150])->orderBy('price', 'asc');
        } elseif ($this->selectedPriceRange === '150-200') {
            $query->whereBetween('price', [150, 200])->orderBy('price', 'asc');
        } elseif ($this->selectedPriceRange === '200-250') {
            $query->whereBetween('price', [200, 250])->orderBy('price', 'asc');
        } elseif ($this->selectedPriceRange === '250+') {
            $query->where('price', '>=', 250)->orderBy('price', 'asc');
        }
    }

    public function setCategory($categoryId)
    {
        $this->resetFilters('category');
        $this->selectedCategory = $categoryId;
        $this->mount();
    }

    public function selectSize($size)
    {
        $this->resetFilters('size');
        $this->selectedSize = $size;
        $this->mount();
    }

    public function selectColor($color)
    {
        $this->resetFilters('color');
        $this->selectedColor = $color;
        $this->mount();
    }

    public function selectPriceRange($priceRange)
    {
        $this->resetFilters('price');
        $this->selectedPriceRange = $priceRange;
        $this->mount();
    }

    public function setSearchTerm($searchTerm)
    {
        $this->resetFilters('search');
        $this->searchTerm = $searchTerm;
        $this->mount();
    }

    private function resetFilters($except = null)
    {
        // Reset filters based on the except parameter
        if ($except !== 'category') {
            $this->selectedCategory = null;
        }
        if ($except !== 'size') {
            $this->selectedSize = null;
        }
        if ($except !== 'color') {
            $this->selectedColor = null;
        }
        if ($except !== 'price') {
            $this->selectedPriceRange = null;
        }
        // Reset search term as well if any filter is applied
        if ($except !== 'search') {
            $this->searchTerm = '';
        }
    }

    private function checkIfInFavorite($productId)
    {
        return Favorite::where('user_id', $this->user_id)
            ->where('product_id', $productId)
            ->exists();
    }

    private function calculateStars($reviews)
    {
        if ($reviews->isEmpty()) {
            return 0;
        }

        $average = $reviews->avg('rating');

        // Round the average rating to one decimal place
        return round($average, 1);
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
                'text' => 'Item added to your favorites successfully.',
                'icon' => 'success',
            ]);
            $this->loadProducts();
            $this->dispatch('refreshPage');

        }
    }

    public function addToCart($id)
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
        $inventoryCheck = Inventory::where('product_id', $this->product->id)->first();
        if ($inventoryCheck->stock == 0) {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'This product is out of stock.',
                'icon' => 'warning',
            ]);
            return;
        }
        if ($this->quantity > $inventoryCheck->stock) {
            $this->dispatch('swal:alert', [
                'title' => 'Insufficient Stock!',
                'text' => "Sorry, we only have {$inventoryCheck->stock} items available for this product. Please adjust your order quantity.",
                'icon' => 'error',
            ]);
            return;
        }

        // Create or retrieve the user's cart
        $cart = Cart::firstOrCreate(['user_id' => $this->user_id]);

        // Decode the size and color arrays, then select a random option from each
        $sizes = json_decode($this->product->size, true);
        $colors = json_decode($this->product->color, true);
        $randomSize = $sizes[array_rand($sizes)];
        $randomColor = $colors[array_rand($colors)];

        // Check if the item already exists in the cart
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $this->product->id)
            ->first();

        if ($existingItem) {
            $this->dispatch('swal:alert', [
                'title' => 'Item Already in Cart',
                'text' => 'This item is already in your cart.',
                'icon' => 'info',
            ]);
        } else {
            // Add the item to the cart with the random size and color
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $this->product->id,
                'size' => $randomSize,
                'color' => $randomColor,
                'quantity' => $this->quantity,
            ]);

            $inventoryCheck->update([
                'stock' => $inventoryCheck->stock - $this->quantity,
            ]);

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
        return view('livewire.website.shop.shop', [
            'products' => $this->products,
        ])->layout('layout.website.app');
    }
}
