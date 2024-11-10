<div class="content-wrapper">
    <div class="p-4 fieldset-border">
        <legend class="fieldset-legend text-primary">Contact Messages</legend>

        <div class="mt-3 shadow-sm card">
            <div class="card-body">
                <div class="table-responsive">
                    {{-- Success and Error Messages --}}
                   

                    {{-- Table or No Message Notification --}}
                    @if ($contacts->isEmpty())
                        <div class="mt-4 text-center alert alert-info">
                            There are no contact messages. <a href="{{ route('home') }}" class="text-primary">Return to Home</a>
                        </div>
                    @else
                        <table class="table align-middle table-hover table-striped custom-table">
                            <thead class="bg-light text-muted">
                                <tr class="text-center">
                                    <th>UserID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Received At</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr class="text-center align-middle">
                                        <td>{{ $contact->user->id  }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->created_at->format('M d, Y h:i A') }}</td>
                                        <td>
                                            <button 
                                                class="btn btn-info btn-sm" 
                                                wire:click="showMessage({{ $contact->id }})" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#messageModal">
                                                View Message
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $contacts->links() }}

                    @endif
                </div>
            </div>
        </div>
    </div>

   {{-- Message Modal --}}
<div wire:ignore.self class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="border-0 shadow-sm modal-content rounded-3">
            <div class="text-white modal-header bg-primary rounded-top">
                <h5 class="modal-title" id="messageModalLabel">Message Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="p-4 modal-body">
                <div class="message-content">
                    <p class="text-secondary">{{ $selectedMessage }}</p>
                </div>
            </div>
            <div class="modal-footer justify-content-end border-top-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>
