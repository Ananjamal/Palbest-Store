<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Inventory;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $category_id;
    public $productName;
    public $productDescription;
    public $productPrice;
    public $productSize = [];
    public $productColor = [];

    public $productImage;
    public $initialStock; // New field for initial stock

    protected $rules = [
        'category_id' => 'required|exists:categories,id',
        'productName' => 'required|string|max:255',
        'productDescription' => 'required|string|max:500',
        'productPrice' => 'required|numeric|min:0',
        'productSize' => 'required|array', // Ensure it's an array
        'productSize.*' => 'required|string|max:50', // Validate each size entry
        'productColor' => 'required|array', // Ensure it's an array
        'productColor.*' => 'required|string|max:50', // Validate each color entry
        'productImage' => 'required|image|max:1024',
        'initialStock' => 'required|integer|min:1', // New validation rule for initial stock
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function CreateProduct()
    {
        $this->validate();

        $imagePath = $this->productImage->store('products', 'public');

        $product = Product::create([
            'name' => $this->productName,
            'category_id' => $this->category_id,
            'description' => $this->productDescription,
            'price' => $this->productPrice,
            'size' => json_encode($this->productSize), // Store selected sizes as JSON
            'color' => json_encode($this->productColor), // Store selected colors as JSON
            'image' => $imagePath, // Ensure this value is passed correctly
        ]);
        // Create an inventory record for this product
        Inventory::create([
            'product_id' => $product->id,
            'stock' => $this->initialStock, // Use the initial stock entered by the user
        ]);
        // Reset input fields
        $this->reset(['productName', 'category_id', 'productDescription', 'productPrice', 'productSize', 'productColor', 'productImage','initialStock']);

        // Dispatch events to show success message and close the modal
        $message = 'Product successfully created.';
        $this->dispatch('successflash', $message);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal'); // Close modal after successful creation
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.products.create', [
            'categories' => $categories,
        ]);
    }
}
