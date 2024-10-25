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
            <input type="text" class="form-control" id="discount" placeholder="Enter discount number"
                wire:model.defer="discount_amount">
            @error('discount_amount')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="code" class="form-label">Coupon Valid From</label>
            <input type="date" class="form-control" id="valid_from" wire:model.defer="valid_from">
            @error('valid_from')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="code" class="form-label">Coupon Valid Until</label>
            <input type="date" class="form-control" id="valid_until" wire:model.defer="valid_until">
            @error('valid_until')
                <span class="error text-danger">{{ $message }}</span>
            @enderror

        </div>

    </div>

    <div class="modal-footer d-flex justify-content-between">
        <button type="button" wire:click='refresh' class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <button wire:click="UpdateCoupon" class="btn btn-primary">
            Save
            <span wire:loading wire:target="UpdateCoupon" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
        </button>

    </div>
</div>
