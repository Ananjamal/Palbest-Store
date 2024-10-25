<div>

    <div class="modal-body">
        <p>Are you sure you want to delete this product from your cart? This action cannot be undone.</p>
    </div>
    <div class="modal-footer">
        <button type="button" wire:click='refresh' class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" wire:click="deleteCartItem" class="btn btn-danger">Delete</button>
    </div>

</div>
