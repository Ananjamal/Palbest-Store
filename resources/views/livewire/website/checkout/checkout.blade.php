<div>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('/') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <div class="row">
                    <div class="col-lg-8 col-md-6">


                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input wire:model='first_name' type="text">
                                </div>
                                @error('first_name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input wire:model='last_name' type="text">
                                </div>
                                @error('last_name')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input wire:model='country' type="text">
                            @error('country')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input wire:model='address' type="text" placeholder="Street Address"
                                class="checkout__input__add">
                            @error('address')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input wire:model='city' type="text">
                            @error('city')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <p>State<span>*</span></p>
                            <input wire:model='state' type="text">
                            @error('state')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input wire:model='zip_code' type="number">
                            @error('zip_code')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input wire:model='phone' type="number">
                                    @error('phone')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input wire:model='email' type="email">
                                    @error('email')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button wire:click="saveCheckoutData" class="btn btn-primary mt-4">Save
                            <span wire:loading wire:target="saveCheckoutData" class="spinner-border spinner-border-sm"
                                role="status" aria-hidden="true"></span>

                        </button>

                        <!-- Success Message -->
                        @if (session()->has('message'))
                            <div class="alert alert-success mt-2">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="p-4 mb-4 checkout__order card">
                            <h4 class="mb-3 order__title">Your order</h4>

                            <div class="mb-2 checkout__order__products d-flex justify-content-between">
                                <strong>Product</strong>
                                <strong>Total</strong>
                            </div>

                            <ul class="mb-3 checkout__total__products list-group">
                                @foreach ($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $loop->iteration }}. {{ $item->product->name }}
                                        (x{{ $item->quantity }})
                                        <span>$
                                            {{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="mb-3 checkout__total__all list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Subtotal
                                    <span>${{ number_format($subTotal, 2) }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Discount
                                    <span>{{ $discount_amount }}%
                                        (${{ number_format($discountPercentage, 2) }})

                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total
                                    <span>${{ number_format($totalPrice, 2) }}</span>
                                </li>
                            </ul>


                            <div class="{{ !$isSaved ? 'disabled-state' : '' }}">
                                <h4 class="payment-title">Choose Your Payment Method</h4> <!-- Title added here -->

                                @if (!$paid)
                                    <div class="checkout__input__checkbox">
                                        <label for="payment_check">
                                            Direct Payment
                                            <input type="radio" id="payment_check" wire:click='setPaymentMethod'
                                                wire:model="payment_method" value="check">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="checkout__input__checkbox">
                                        <label for="payment_creditcard">
                                            Credit Card
                                            <input type="radio" id="payment_creditcard" data-bs-toggle="modal"
                                                data-bs-target="#CreditModal" wire:click='setPaymentMethod'
                                                wire:model="payment_method" value="creditcard">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @else
                                    <div class="alert alert-success mt-4 p-3 rounded border-success">
                                        <h4 class="alert-heading"><i class="bi bi-check-circle-fill"></i> Payment
                                            Successful!</h4>
                                        <p class="mb-1"><strong>Payment Method:</strong> {{ $payment_method }}</p>
                                        <p class="mb-1"><strong>Payment Status:</strong> Paid successfully</p>
                                        <hr>
                                        <p class="mb-0">Thank you for your payment. Your transaction was successful!
                                        </p>
                                    </div>
                                @endif

                                @error('payment_method')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror

                                <!-- Place Order Button -->
                                <button wire:click="placeOrder" class="btn btn-primary btn-block">
                                    PLACE ORDER
                                    <span wire:loading wire:target="placeOrder"
                                        class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </button>
                            </div>




                        </div>

                    </div>

                    <div wire:ignore class="modal fade" id="CreditModal" tabindex="-1"
                        aria-labelledby="creditModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="creditModalLabel">Credit Card Payment</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container mt-4">
                                        <h2 class="text-center mb-4">Enter Your Payment Details</h2>
                                        <form id="payment-form">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="card-element" class="form-label">Card Number</label>
                                                <div id="card-element" class="form-control"></div>
                                                <div id="card-errors" role="alert" class="text-danger mt-2">
                                                </div>
                                            </div>

                                            <button type="button" id="submit-button"
                                                class="btn btn-success btn-block" disabled>
                                                <span class="spinner-border spinner-border-sm me-2" role="status"
                                                    aria-hidden="true" id="loading-spinner"
                                                    style="display: none;"></span>
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

                                                const submitButton = document.getElementById('submit-button');
                                                const loadingSpinner = document.getElementById('loading-spinner');

                                                submitButton.disabled = false; // Enable button when page loads

                                                submitButton.addEventListener('click', async () => {
                                                    submitButton.disabled = true; // Disable the button to prevent multiple clicks
                                                    loadingSpinner.style.display = "inline-block"; // Show spinner

                                                    const {
                                                        error,
                                                        token
                                                    } = await stripe.createToken(cardElement);

                                                    if (error) {
                                                        document.getElementById('card-errors').textContent = error.message;
                                                        loadingSpinner.style.display = "none"; // Hide spinner on error
                                                        submitButton.disabled = false; // Re-enable the button
                                                    } else {
                                                        @this.set('token', token.id);
                                                        @this.call('processPayment');
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>

</div>
