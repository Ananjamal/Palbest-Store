<?php

namespace App\Livewire\Website\Orders;

use Livewire\Component;

class OrderDetails extends Component
{
    public $orderItems;
    public $counter;
    public function mount($id)
    {
        $this->orderItems = OrderItem::where('order_id', $id)->get();
    }
    public function render()
    {
        return view('livewire.website.orders.order-details');
    }
}
