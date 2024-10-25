<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $category;
    public $categoryName;
    public $categoryDescription;
    public $newImage;
    protected $rules = [
        'categoryName' => 'min:3',
        'categoryDescription' => 'min:3',
        'newImage' => 'nullable',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount($id)
    {
        $this->category = Category::FindOrFail($id);
        $this->categoryName = $this->category->name;
        $this->categoryDescription = $this->category->description;
        // $this->categoryImage = $category->image;
    }

    public function Edit()
    {
        $this->validate();
        $data = [
            'name' => $this->categoryName,
            'description' => $this->categoryDescription,
        ];
        if ($this->newImage) {
            Storage::disk('public')->delete($this->category->image);
            $data['image'] = $this->newImage->store('categories', 'public');
        }
        $this->category->update($data);
        $this->reset(['categoryName', 'categoryDescription', 'newImage']);
        $message = 'category successfully updated.';
        $this->dispatch('flash', $message);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal');
    }
    public function refresh()
    {
        $this->dispatch('refreshPage');
    }
    public function render()
    {
        return view('livewire.admin.categories.edit');
    }
}
