<div>
    <div class="modal-body">
        <div class="form-group">
            <label for="code" class="form-label">Coupon Code</label>
            <input type="text" class="form-control" id="code" placeholder="Enter coupon Code"
                wire:model.defer="code">
            @error('code')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="code" class="form-label">Coupon Discount $</label>
            <input type="number" class="form-control" id="discount" placeholder="Enter discount number"
                wire:model.defer="discount">
            @error('discount')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="code" class="form-label">Coupon Valid From</label>
            <input type="date" class="form-control" id="valid_from" placeholder="Enter coupon valid from"
                wire:model.defer="valid_from">
            @error('valid_from')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="code" class="form-label">Coupon Valid Until</label>
            <input type="date" class="form-control" id="valid_until" placeholder="Enter coupon valid until"
                wire:model.defer="valid_until">
            @error('code')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

    </div>

    <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <button wire:click="create" class="btn btn-primary">
            Save
            <span wire:loading wire:target="create" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
        </button>

    </div>
</div>
