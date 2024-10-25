<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\Inventory;

class UpdateStock extends Component
{
    public $product_id;
    public $stock;
    public $inventory;

    protected $rules = [
        'stock' => 'numeric|min:1',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function mount($id)
    {
        $this->product_id = $id;
        $this->inventory = Inventory::where('product_id', $this->product_id)->first();
        $this->stock = $this->inventory->stock;
    }
    public function update()
    {
        $this->validate();
        $this->inventory->update([
            'stock' => $this->stock,
        ]);
        $message = 'Stock successfully updated.';
        $this->dispatch('successflash', $message);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal'); // Close modal after successful creation
    }
    public function refresh()
    {
        $this->dispatch('refreshPage');
    }
    public function render()
    {
        return view('livewire.admin.inventory.updatestock');
    }
}
