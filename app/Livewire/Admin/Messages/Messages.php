<?php

namespace App\Livewire\Admin\Messages;

use App\Models\Contacts;
use Livewire\Component;

class Messages extends Component
{
    public $selectedMessage;

    public function showMessage($contactId)
    {
        $contact = Contacts::find($contactId);
        $this->selectedMessage = $contact ? $contact->message : 'Message not found';
    }

    public function render()
    {
        $contacts = Contacts::with('user')->latest()->get();

        return view('livewire.admin.messages.messages', compact('contacts'))->layout('layout.admin.app');
    }
}
