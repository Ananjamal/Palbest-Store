<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $categoryName;
    public $categoryDescription;
    public $categoryImage;
    protected $rules = [
        'categoryName' => 'required|min:3',
        'categoryDescription' => 'required|min:3',
        'categoryImage' => 'required|image|mimes:jpg,jpeg,png,gif',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function CreateCategory()
    {
        $this->validate();

        if ($this->categoryImage) {
            $imageName = $this->categoryImage->store('categories', 'public');
        }

        // Save the category (adjust according to your database schema)
        Category::create([
            'name' => $this->categoryName,
            'description' => $this->categoryDescription,
            'image' => $imageName
        ]);

        $this->reset(['categoryName', 'categoryDescription', 'categoryImage']);

        $message = 'category successfully created.';
        $this->dispatch('successflash', $message);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal'); // This will now close the modal

    }
    public function refresh()
    {
        $this->emit('refreshPage');
    }
    public function render()
    {
        return view('livewire.admin.categories.create');
    }
}
