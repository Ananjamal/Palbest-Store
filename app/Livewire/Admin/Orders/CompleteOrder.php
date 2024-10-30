<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\Order;

class CompleteOrder extends Component
{
    public $order;

    public function mount($id)
    {
        $this->order = Order::findOrFail($id);
    }

    public function completeOrder()
    {
        if ($this->order->status === 'delivered') {
            $message = 'This order has already been delivered, and no further actions are needed. ';
            $this->dispatch('errorflash', $message);
        } elseif ($this->order->status === 'canceled') {
            $message = 'The order cannot be completed because it has already been marked as canceled.';
            $this->dispatch('errorflash', $message);
        } else {
            $this->order->status = 'delivered';
            $this->order->save();

            $message = 'Order is successfully marked as delivered.';
            $this->dispatch('successflash', $message);        }

        $this->dispatch('refreshPage');
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.admin.orders.complete-order');
    }
}
