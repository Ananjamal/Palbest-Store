<div class="container mt-4">
    <h2 class="text-center mb-4">Complete Your Payment</h2>
    <form wire:submit.prevent="processPayment">
        <div class="mb-3">
            <label for="paypal_email" class="form-label">PayPal Email</label>
            <input type="email" id="paypal_email" wire:model="paypal_email" class="form-control" placeholder="example@paypal.com" required>
            @error('paypal_email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <p class="text-muted">Total Amount: <strong>${{ number_format($totalPrice, 2) }}</strong></p>
        </div>

        <button type="submit" class="btn btn-success btn-block">
            <i class="fab fa-paypal"></i> Pay with PayPal
        </button>
    </form>
    
    <div class="mt-3 text-center">
        <small class="text-muted">By clicking "Pay with PayPal", you agree to our <a href="#" class="text-primary">terms and conditions</a>.</small>
    </div>
</div>
