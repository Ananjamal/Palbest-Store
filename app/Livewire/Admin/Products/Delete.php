<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public $product;
    public function refresh()
    {
        $this->dispatch('refreshPage');
    }
    public function mount($id)
    {
        $this->product = Product::FindOrFail($id);
    }
    public function delete()
    {
        if ($this->product) {
            // Check if the product image exists before deleting
            if ($this->product->image) {
                Storage::disk('public')->delete($this->product->image);
            }

            $this->product->delete();

            $message = 'Product Deleted Successfully';
            $this->dispatch('successflash', $message);
            $this->dispatch('refreshPage');
            $this->dispatch('close-modal');
        } else {
            $message = 'Product Not Found';
            $this->dispatch('errorflash', $message);
        }
    }
    public function render()
    {
        return view('livewire.admin.products.delete');
    }
}
