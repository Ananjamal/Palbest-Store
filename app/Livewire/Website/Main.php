<?php

namespace App\Livewire\Website;

use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        return view('livewire.website.main')->layout('layout.website.app');
    }
}
