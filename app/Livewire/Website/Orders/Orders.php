<?php

namespace App\Livewire\Website\Orders;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Orders extends Component
{
    public $orders;
    public $user_id;

    protected $listeners = ['cancelOrder' => 'handleCancelOrder'];

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->orders = Order::where('user_id', $this->user_id)->get();
    }

    public function confirmCancelOrder($id)
    {
        // Dispatch an event to trigger a confirmation
        $this->dispatch('confirm-cancel', ['orderId' => $id]);
    }

    public function handleCancelOrder($id)
    {
        // Debugging to check if this method is triggered
        dd('Function triggered with ID: ' . $id);

        $order = Order::find($id);
        if ($order) {
            $order->status = 'cancelled';
            $order->save();
            // Update the orders collection to reflect the cancelled order
            $this->orders = $this->orders->reject(fn($o) => $o->id === $id);
        }
    }

    public function render()
    {
        return view('livewire.website.orders.orders')->layout('layout.website.app');
    }
}
