<?php

namespace App\Livewire\Admin\Inventory;

use App\Models\Product;
use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\On;

class Inventories extends Component
{
    public $product_id;
    public $searchTerm;

    #[On('successflash')]
    public function flash($message)
    {
        session()->flash('success', $message);
    }
    #[On('errorflash')]
    public function errorflash($message)
    {
        session()->flash('error', $message);
    }

    #[On('refreshPage')]
    public function refresh()
    {
        $this->product_id = null;
    }
    #[On('search')]
    public function search($message)
    {
        $product = Product::where('name', 'like', '%' . $message . '%')->first();

        $this->product_id = $product->id;
        $this->searchTerm = $this->product_id;
    }
    public function editStock($id)
    {
        $this->product_id = $id;
    }
    public function render()
    {
        $inventory = Inventory::where('product_id', 'like', '%' . $this->searchTerm . '%')->get();
        return view('livewire.admin.inventory.inventories', [
            'inventory' => $inventory,
        ])->layout('layout.admin.app');
    }
}
