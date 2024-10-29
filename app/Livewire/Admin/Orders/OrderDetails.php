<?php

namespace App\Livewire\Admin\Orders;

use Livewire\Component;
use App\Models\OrderItem;

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
        return view('livewire.admin.orders.order-details');
    }
}
