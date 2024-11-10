<?php

namespace App\Livewire\Admin\Messages;

use App\Models\Contacts;
use Livewire\Component;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $selectedMessage;

    public function showMessage($contactId)
    {
        $contact = Contacts::find($contactId);
        $this->selectedMessage = $contact ? $contact->message : 'Message not found';
    }

    public function render()
    {
        $contacts = Contacts::with('user')->latest()->paginate(10);

        return view('livewire.admin.messages.messages', compact('contacts'))->layout('layout.admin.app');
    }
}
