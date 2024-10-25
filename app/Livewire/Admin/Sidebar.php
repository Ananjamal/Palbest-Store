<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public function render()
    {
        $user = Auth::user(); // Alternatively, you could use Auth::user() to get the full user object
        return view('livewire.admin.sidebar',[
            'user' => $user,
        ]);
    }
}
