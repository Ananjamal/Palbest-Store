<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;

class Products extends Component
{
    public $category_id;
    public $product_id;

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
    public function deleteProduct($id)
    {

        $this->product_id = $id;
    }
    public function editProduct($id)
    {
        $this->product_id = $id;
    }
    public function render()
    {
        $products = Product::latest()->get();
        return view('livewire.admin.products.products', [
            'products' => $products,
        ])->layout('layout.admin.app');
    }
}
