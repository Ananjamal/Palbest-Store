<?php

namespace App\Livewire\Website\Cart;

use Livewire\Component;
use App\Models\CartItem;

class Delete extends Component
{
    public $cartItem;
    public function mount($id){
        $this->cartItem = CartItem::FindOrFail($id);
    }
    public function deleteCartItem(){
        $this->cartItem->delete();
        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Item deleted from your cart successfully.',
            'icon' => 'success',
        ]);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.website.cart.delete');
    }
}
