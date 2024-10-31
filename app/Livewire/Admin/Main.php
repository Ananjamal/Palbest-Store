<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class Main extends Component
{
    public function render()
    {
        return view('livewire.admin.main')->layout('layout.admin.app');
    }
}
