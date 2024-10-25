<?php

namespace App\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;

class Edit extends Component
{
    public $coupon_id;
    public $coupon;
    public $code;
    public $discount_amount;
    public $valid_from;
    public $valid_until;
    public function mount($id){
        $this->coupon = Coupon::find($id);
        if (!$this->coupon) {
            return;
        }
        $this->code = $this->coupon->code;
        $this->discount_amount = $this->coupon->discount_amount;
        $this->valid_from = $this->coupon->valid_from->format('Y-m-d') ;
        $this->valid_until = $this->coupon->valid_until ->format('Y-m-d');
    }

    public function UpdateCoupon(){
        $this->validate([
            'code' => 'min:4',
            'discount_amount' => 'min:1|numeric',
            'valid_from' => 'date',
            'valid_until' => 'date',
        ]);
        $data = [
            'code' => $this->code,
            'discount_amount' => $this->discount_amount,
            'valid_from' => $this->valid_from,
            'valid_until' => $this->valid_until,
        ];
        $this->coupon->update($data);
        $this->reset(['code', 'discount_amount', 'valid_from', 'valid_until']);
        $message = 'Coupon successfully Updated.';
        $this->dispatch('successflash', $message);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal');
    }
    public function refresh()
    {
        $this->dispatch('refreshPage');
    }
    public function render()
    {
        return view('livewire.admin.coupons.edit');
    }
}
