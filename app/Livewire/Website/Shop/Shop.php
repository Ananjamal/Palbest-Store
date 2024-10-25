<?php

namespace App\Livewire\Website\Shop;

use Livewire\Component;

class Shop extends Component
{
    public function render()
    {
        return view('livewire.website.shop.shop')->layout('layout.website.app');
    }
}
