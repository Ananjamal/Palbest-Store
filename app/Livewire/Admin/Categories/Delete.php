<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class Delete extends Component
{
    public $category;
    public function refresh()
    {
        $this->dispatch('refreshPage');
    }
    public function mount($id)
    {
        $this->category = Category::FindOrFail($id);
    }
    public function delete()
    {
        if ($this->category) {
            // Check if the product image exists before deleting
            if ($this->category->image) {
                Storage::disk('public')->delete($this->category->image);
            }

            $this->category->delete();

            $message = 'Category Deleted Successfully';
            $this->dispatch('successflash', $message);
            $this->dispatch('refreshPage');
            $this->dispatch('close-modal');
        } else {
            $message = 'Category Not Found';
            $this->dispatch('errorflash', $message);
        }
    }
    public function render()
    {
        return view('livewire.admin.categories.delete');
    }
}
