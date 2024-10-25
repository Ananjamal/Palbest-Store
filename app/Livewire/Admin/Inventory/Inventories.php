<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\Attributes\On;

class Inventories extends Component
{
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
    public function editStock($id){
        $this->product_id = $id;
    }
    public function render()
    {
        $inventory = Inventory::all();
        return view('livewire.admin.inventory.inventories',[
            'inventory' => $inventory
        ])->layout('layout.admin.app');
    }
}
