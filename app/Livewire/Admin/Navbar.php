<?php
namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $searchTerm = '';
    public $results = [];

    public function updatedSearchTerm()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        if (trim($this->searchTerm) === '') {
            $this->results = [];
            return;
        }
        $message = $this->searchTerm;
        $this->dispatch('search',$message);

    }

    public function clearSearch()
    {
        $this->searchTerm = '';
        $this->results = [];
    }

    public function render()
    {
        $user = Auth::user();
        return view('livewire.admin.navbar', [
            'user' => $user,
        ]);
    }
}
