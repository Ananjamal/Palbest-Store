<div>
    <div class="modal-body">
        <div class="form-group">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" placeholder="Enter stock number"
                wire:model.defer="stock">
            @error('stock')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" wire:click='refresh' data-bs-dismiss="modal">Close</button>

        <button wire:click="update" class="btn btn-primary">
            Update
            <span wire:loading wire:target="update" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
        </button>

    </div>
</div>
