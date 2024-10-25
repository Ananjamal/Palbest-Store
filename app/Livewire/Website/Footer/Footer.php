<?php

namespace App\Livewire\Website\Footer;

use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.website.footer.footer')->layout('layout.website.app');
    }
}
