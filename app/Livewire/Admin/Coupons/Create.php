<?php

namespace App\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Create extends Component
{
    public $code;
    public $discount;
    public $valid_from;
    public $valid_until;
    protected $rules = [
        'code' => 'required|min:3',
        'discount' => 'required|min:1|numeric',
        'valid_from' => 'required|min:6',
        'valid_until' => 'required|min:6',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->valid_from = Carbon::now()->format('Y-m-d');
    }
    public function create()
    {
        $validatedData = $this->validate();
        Coupon::create([
            'code' => $this->code,
            'discount_amount' => $this->discount,
            'valid_from' => $this->valid_from,
            'valid_until' => $this->valid_until,
            'is_active' => true,
        ]);

        $this->reset(['code', 'discount', 'valid_from', 'valid_until']);
        $message = 'Coupon successfully created.';
        $this->dispatch('successflash', $message);
        $this->dispatch('refreshPage');
        $this->dispatch('close-modal'); // This will now close the modal
    }
    public function render()
    {
        return view('livewire.admin.coupons.create');
    }
}
