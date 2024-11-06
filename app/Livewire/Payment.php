<?php

namespace App\Livewire;

use Livewire\Component;
use Stripe\Stripe;
use Stripe\Charge;

class Payment extends Component
{


    public function render()
    {
        return view('livewire.payment')->layout('layout.website.payment');
    }
}
