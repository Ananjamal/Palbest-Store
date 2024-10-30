<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;

class Orders extends Component
{
    public $orders;
    public $order_id;
    public function mount()
    {
        $this->orders = Order::all();
    }
    public function completeOrder($id)
    {
        $this->order_id = $id;
    }

    public function orderDetails($id)
    {
        $this->order_id = $id;
    }
    #[On('refreshPage')]
    public function refresh()
    {
        $this->order_id = null;
        $this->mount();
    }
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


    public function render()
    {
        return view('livewire.admin.orders.orders')->layout('layout.admin.app');
    }
}
