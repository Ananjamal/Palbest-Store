{{-- <div class="container mt-4">
    <h2 class="mb-4 text-center">Enter Your Payment Details</h2>
    <form wire:submit.prevent="processPayment">
        <div class="mb-3">
            <label for="card_number" class="form-label">Card Number</label>
            <input type="text" id="card_number" wire:model="card_number" class="form-control" maxlength="19" placeholder="1234 5678 9012 3456" >
            @error('card_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 row">
            <div class="col">
                <label for="expiry_date" class="form-label">Expiry Date (MM/YY)</label>
                <input type="text" id="expiry_date" wire:model="expiry_date" class="form-control" placeholder="MM/YY" >
                @error('expiry_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="cvc" class="form-label">CVC</label>
                <input type="text" id="cvc" wire:model="cvc" class="form-control" maxlength="4" placeholder="CVC" >
                @error('cvc')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block">
            <i class="fas fa-credit-card"></i> Pay Now
        </button>
    </form>

    <div class="mt-3 text-center">
        <small class="text-muted">Secure payment processed by our trusted partners.</small>
    </div>
</div> --}}
{{-- <div class="container mt-4">
    <h2 class="mb-4 text-center">Enter Your Payment Details</h2>
    <form id="payment-form">
        @csrf
        <div class="mb-3">
            <label for="card_number" class="form-label">Card Number</label>
            <input type="text" id="card_number" wire:model="card_number" class="form-control" maxlength="19" placeholder="1234 5678 9012 3456">
            @error('card_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 row">
            <div class="col">
                <label for="expiry_date" class="form-label">Expiry Date (MM/YY)</label>
                <input type="text" id="expiry_date" wire:model="expiry_date" class="form-control" placeholder="MM/YY">
                @error('expiry_date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="cvc" class="form-label">CVC</label>
                <input type="text" id="cvc" wire:model="cvc" class="form-control" maxlength="4" placeholder="CVC">
                @error('cvc')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block">
            <i class="fas fa-credit-card"></i> Pay Now
        </button>
    </form>

    <div class="mt-3 text-center">
        <small class="text-muted">Secure payment processed by our trusted partners.</small>
    </div>
</div> --}}

{{-- <div class="container mt-4">
    <h2 class="mb-4 text-center">Enter Your Payment Details</h2>
    <form id="payment-form">
        @csrf
        <div class="mb-3">
            <label for="card-element" class="form-label">Card Number</label>
            <div id="card-element" class="form-control"></div> <!-- Stripe Card Element -->
            @error('card_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success btn-block">
            <i class="fas fa-credit-card"></i> Pay Now
        </button>
    </form>

    <div class="mt-3 text-center">
        <small class="text-muted">Secure payment processed by our trusted partners.</small>
    </div>
</div> --}}
{{-- <div class="container mt-4">
    <h2 class="text-center mb-4">Enter Your Payment Details</h2>
    <form wire:submit.prevent="processPayment">
        @csrf
        <div class="mb-3">
            <label for="card-number" class="form-label">Card Number</label>
            <input type="text" id="card-number" class="form-control" wire:model="card_number" maxlength="16" placeholder="1234 5678 9012 3456">
            @error('card_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exp-month" class="form-label">Expiry Month (MM)</label>
            <input type="number" id="exp-month" class="form-control" wire:model="exp_month" min="1" max="12" placeholder="MM">
            @error('exp_month')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exp-year" class="form-label">Expiry Year (YY)</label>
            <input type="number" id="exp-year" class="form-control" wire:model="exp_year" min="{{ date('y') }}" placeholder="YY">
            @error('exp_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cvc" class="form-label">CVC</label>
            <input type="number" id="cvc" class="form-control" wire:model="cvc" maxlength="4" placeholder="123">
            @error('cvc')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success btn-block">
            <i class="fas fa-credit-card"></i> Pay Now
        </button>
    </form>

    <div class="mt-3 text-center">
        <small class="text-muted">Secure payment processed by our trusted partners.</small>
    </div>
</div> --}}

<!-- resources/views/livewire/credit-card-payment-modal.blade.php -->
<div class="container mt-4">
    <h2 class="text-center mb-4">Enter Your Payment Details</h2>

    <!-- Include Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>

    <form id="payment-form">
        @csrf
        <div class="mb-3">
            <label for="card-element" class="form-label">Card Number</label>
            <div id="card-element" class="form-control"></div> <!-- Stripe Card Element -->
            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
        </div>

        <button type="button" id="submit-button" class="btn btn-success btn-block">
            <i class="fas fa-credit-card"></i> Pay Now
        </button>
    </form>

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
