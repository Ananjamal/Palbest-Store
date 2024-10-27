<?php

namespace App\Http\Livewire\Website\Orders;

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

        if ($order->status == 'cancelled') {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Order is already cancelled.']);
            $this->emit('hideModal', 'cancelOrder'); // Emit event to notify JS
            return;
        }

        $order->update(['status' => 'cancelled']);

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Your order has been successfully canceled.']);
        $this->emit('hideModal', 'cancelOrder'); // Emit event to notify JS

        $this->emit('refreshPage');
    }
    public function refresh()
    {
        $this->emit('refreshPage');
    }

    public function render()
    {
        return view('livewire.website.orders.cancel-order')->layout('layout.website.orders');
    }
}
