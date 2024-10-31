<?php

namespace App\Livewire\Website\Header;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Header extends Component
{
    public $favorites;
    public $favoriteCount;
    public $cartCount;
    public $cartItems;
    public $cart;
    public $user_id;
    public $ordersCount;
    public $searchTerm = ''; // Initialized as an empty string
    public $results = []; // Initialized as an empty array

    // public function refresh(){
    // }
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

    public function setSearchTerm($term)
    {
        $this->searchTerm = $term;
    }

    public function loadProducts()
    {
        // Check if the search term is not empty before querying
        if (trim($this->searchTerm) === '') {
            $this->results = []; // Clear results if search term is empty
            return; // Exit the method if there's no search term
        }

        // Search for products that match the search term
        $this->results = Product::where('name', 'like', '%' . $this->searchTerm . '%')->get();
    }


    public function clearSearch()
    {
        // Clear the search term and results
        $this->searchTerm = '';
        $this->results = [];
    }

    public function render()
    {
        return view('livewire.website.header.header');
    }
}
