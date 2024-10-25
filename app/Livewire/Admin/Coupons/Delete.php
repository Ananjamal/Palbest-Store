<?php

namespace App\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;

class Delete extends Component
{
    public $coupon;
    public $coupon_id;
    public function mount($id)
    {
        $this->coupon_id = $id;
        $this->coupon = Coupon::find($id);
    }
    public function delete()
    {
        $this->coupon->delete();

        $message = 'Coupon Deleted Successfully';
        $this->dispatch('successflash', $message);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal'); // This will now close the modal
    }
    public function refresh()
    {
        $this->dispatch('refreshPage');
    }
    public function render()
    {
        return view('livewire.admin.coupons.delete');
    }
}
