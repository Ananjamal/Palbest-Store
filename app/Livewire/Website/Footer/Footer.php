<?php

namespace App\Livewire\Website\Footer;

use Livewire\Component;
use App\Models\Contacts;
use Illuminate\Support\Facades\Auth;

class Footer extends Component
{
    public $message;
    public function sendMessage()
    {
        $user_id = Auth::id();
        if (!$user_id) {
            $this->dispatch('swal:alert', [
                'title' => 'Error',
                'text' => 'Please login first.',
                'icon' => 'warning',
            ]);
            return;
        }
        $this->validate([
            'message' => 'required',
        ]);
        $name = Auth::user()->name;
        $email = Auth::user()->email;

        $contact = new Contacts();
        $contact->user_id = $user_id;
        $contact->name = $name;
        $contact->email = $email;
        $contact->message = $this->message;
        $contact->save();
        $this->reset('message');
        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Your Message Sent Successfully..',
            'icon' => 'success',
        ]);
    }    public function render()
    {
        return view('livewire.website.footer.footer')->layout('layout.website.app');
    }
}
