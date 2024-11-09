<?php

namespace App\Livewire\Website\Contact;

use Livewire\Component;
use App\Models\Contacts;
use Illuminate\Support\Facades\Auth;

class Contact extends Component
{

    public $name;
    public $email;
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
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);


        $contact = new Contacts();
        $contact->user_id = $user_id;
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->message = $this->message;
        $contact->save();
        $this->reset(['name', 'email', 'message']);
        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Your Message Sent Successfully..',
            'icon' => 'success',
        ]);
    }
    public function render()
    {
        return view('livewire.website.contact.contact')->layout('layout.website.app');
    }
}
