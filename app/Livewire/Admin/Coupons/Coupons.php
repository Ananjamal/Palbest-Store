<?php

namespace App\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;
use Livewire\Attributes\On;

class Coupons extends Component
{
    public $counter;
    public $coupon_id;
    #[On('successflash')]
    public function successflash($message)
    {
        session()->flash('message', $message);
    }
    #[On('errorflash')]
    public function errorflash($message)
    {
        session()->flash('error', $message);
    }
    #[On('refreshPage')]
    public function refresh()
    {
        $this->coupon_id = null;
    }
    public function editCoupon($id)
    {
        $this->coupon_id = $id;
    }
    public function deleteCoupon($id)
    {
        $this->coupon_id = $id;
    }

    public function render()
    {
        $coupons = Coupon::latest()->get();
        return view('livewire.admin.coupons.coupons', [
            'coupons' => $coupons,
        ])->layout('layout.admin.app');
    }
}
