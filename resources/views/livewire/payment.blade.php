<div class="container mt-4">
    <h2 class="text-center mb-4">Enter Your Payment Details</h2>

    <!-- Payment Form -->
    <form id="payment-form" style="max-width: 500px; margin: 5 auto; padding: 20px; background-color: #ffffff; border-radius: 12px; box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.15); border: 1px solid #ddd;">
        @csrf
        <div class="form-group mb-3" style="margin-bottom: 1.5rem;">
            <label for="card-element" class="form-label" style="display: block; font-weight: bold; color: #333; margin-bottom: 8px;">Card Number</label>
            <div id="card-element" class="form-control" style="padding: 12px; font-size: 1em; border-radius: 6px; box-shadow: inset 0px 1px 3px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; transition: border-color 0.3s;">
                <!-- Stripe Card Element -->
            </div>
            <div id="card-errors" role="alert" style="color: #dc3545; margin-top: 8px;"></div>
        </div>
    
        <button type="button" id="submit-button" style="width: 100%; padding: 12px; font-size: 1.1em; font-weight: bold; background-color: #28a745; color: #ffffff; border: none; border-radius: 6px; cursor: pointer; transition: background-color 0.3s;">
            <i class="fas fa-credit-card"></i> Pay Now
        </button>
    </form>
    

    <!-- Place Order Button -->
    <button wire:click="placeOrder" class="btn btn-primary btn-block mt-3" wire:loading.attr="disabled">
        PLACE ORDER
        <span wire:loading wire:target="placeOrder" class="spinner-border spinner-border-sm" role="status"
            aria-hidden="true"></span>
    </button>

    @error('payment_method')
        <span class="error text-danger mt-2">{{ $message }}</span>
    @enderror
    <script>
        document.addEventListener("DOMContentLoaded", async () => {
            const stripe = Stripe("{{ env('STRIPE_KEY') }}");
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                hidePostalCode: true
            });
            cardElement.mount('#card-element');

            document.getElementById('submit-button').addEventListener('click', async () => {
                const {
                    error,
                    token
                } = await stripe.createToken(cardElement);

                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                } else {
                    @this.set('token', token.id);
                    @this.call('processPayment');
                }
            });
        });
    </script>

</div>
