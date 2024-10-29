<?php

namespace App\Livewire\Website\Orders;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class Orders extends Component
{
    public $orders;
    public $user_id;
    public $order_id;

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->orders = Order::where('user_id', $this->user_id)->get();
    }

    public function cancelOrder($id)
    {
        $this->order_id = $id;
    }

    public function orderDetails($id)
    {
        $this->order_id = $id;
    }
    #[On('refreshOrder')]
    public function refresh()
    {
        $this->order_id = null;
        $this->mount();
    }

    public function render()
    {
        return view('livewire.website.orders.orders')->layout('layout.website.app');
    }
}
