<div>
    <div class="modal-body text-center" style="padding: 2rem; background-color: #f8f9fa;">
        <i class="fas fa-exclamation-circle" style="color: #dc3545; font-size: 3rem;"></i>
        <p style="margin-top: 1rem; color: #dc3545; font-weight: bold; font-size: 1.5rem;">Are you sure you want to complete the order?</p>
        <p style="color: #6c757d;">This action will finalize the order and cannot be undone.</p>
    </div>
    <div class="modal-footer" style="justify-content: center;">
        <button type="button" wire:click='completeOrder' data-bs-dismiss="modal" class="btn" style="background-color: #28a745; color: white; padding: 0.75rem 1.5rem; font-size: 1.25rem;">Yes, Complete Order</button>
        <button type="button" wire:click='refresh' class="btn" style="background-color: #6c757d; color: white; padding: 0.75rem 1.5rem; font-size: 1.25rem;" data-bs-dismiss="modal">No, Go Back</button>
    </div>
</div>
