<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\Charge;

class Payment extends Component
{
    public $paymentId;
    public $PayerID;
    public $success = false;
    public $cancel = false;

    public function mount($paymentId = null, $PayerID = null)
    {
        $this->paymentId = $paymentId;
        $this->PayerID = $PayerID;

        // Check if payment is successful or canceled based on the input parameters
        if ($this->paymentId && $this->PayerID) {
            // Logic to verify the payment using PayPal API can be implemented here
            // Assuming payment verification is successful
            $this->success = true;
        } else {
            $this->cancel = true; // No payment details means it's a cancel
        }
    }

    public function render()
    {
        return view('livewire.payment');
    }
}
