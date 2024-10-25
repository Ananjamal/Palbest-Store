<?php

namespace App\Livewire\Website\Hero;

use Livewire\Component;

class Hero extends Component
{
    public function render()
    {
        return view('livewire.website.hero.hero')->layout('layout.website.app');
    }
}
