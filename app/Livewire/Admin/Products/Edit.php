<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    public $product;
    public $productId; // Product ID for editing
    public $category_id;
    public $productName;
    public $productDescription;
    public $productPrice;
    public $productSize = [];
    public $productColor = [];
    public $newImage;
    public $currentImage; // To hold the current image path

    protected $rules = [
        'category_id' => 'exists:categories,id',
        'productName' => 'string|max:255',
        'productDescription' => 'string|max:500',
        'productPrice' => 'numeric|min:0',
        'productSize' => 'array',
        'productSize.*' => 'string|max:50',
        'productColor' => 'array',
        'productColor.*' => 'string|max:50',
        'newImage' => 'max:1024', // Image is optional for edit
    ];

    public function mount($id)
    {
        $this->product = Product::find($id);

        $this->category_id = $this->product->category_id;
        $this->productName = $this->product->name;
        $this->productDescription = $this->product->description;
        $this->productPrice = $this->product->price;
        $this->productSize = json_decode($this->product->size, true); // Assuming sizes are stored as JSON
        $this->productColor = json_decode($this->product->color, true); // Assuming colors are stored as JSON
        $this->currentImage = $this->product->image; // Store current image path for display
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editProduct()
    {
        $this->validate();

        $data = [
            'name' => $this->productName,
            'description' => $this->productDescription,
            'price' => $this->productPrice,
            'size' => json_encode($this->productSize),
            'color' => json_encode($this->productColor),
        ];
        if ($this->newImage) {
            Storage::disk('public')->delete($this->product->image);
            $data['image'] = $this->newImage->store('products', 'public');
        }
        $this->product->update($data);

        // Reset input fields
        $this->reset(['productName', 'category_id', 'productDescription', 'productPrice', 'productSize', 'productColor', 'newImage']);

        // Dispatch events to show success message and close the modal
        $message = 'Product successfully updated.';
        $this->dispatch('successflash', $message);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal');
    }
    public function refresh()
    {
        $this->dispatch('refreshPage');
    }
    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.products.edit', [
            'categories' => $categories,
        ]);
    }
}
