<?php

namespace App\Livewire\Website\Orders;

use App\Models\Order;
use Livewire\Component;

class CancelOrder extends Component
{
    public $order_id;

    public function mount($id)
    {
        $this->order_id = $id;
    }

    public function cancelOrder()
    {
        $order = Order::find($this->order_id);

        if ($order->status == 'canceled') {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'Order is already cancelled.',
                'icon' => 'warning',
            ]);
            $this->dispatch('close-modal'); 

            return;
        }

        $order->update(['status' => 'canceled']);
        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Your order has been successfully canceled.',
            'icon' => 'success',
        ]);
        // $this->dispatch('close-modal'); 
        $this->dispatch('refreshOrder');
    }
    public function refresh()
    {
        $this->dispatch('refreshOrder');
    }

    public function render()
    {
        return view('livewire.website.orders.cancel-order')->layout('layout.website.app');
    }
}
