<div >
    <div class="modal-body text-center p-4">
        <i class="fas fa-exclamation-circle text-danger" style="font-size: 2rem;"></i>
        <p class="mt-3 text-danger fw-bold fs-5">Are you sure you want to cancel the order?</p>
    </div>
    <div class="modal-footer justify-content-center">
        <button type="button" wire:click='cancelOrder' data-bs-dismiss="modal" class="btn btn-danger btn-lg px-4">Yes, Cancel Order</button>
        <button type="button" wire:click='refresh' class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">No, Go Back</button>
    </div>
</div>
