<?php

namespace App\Livewire\Website\Contact;

use Livewire\Component;

class Contact extends Component
{
    public function render()
    {
        return view('livewire.website.contact.contact')->layout('layout.website.app');
    }
}
