    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div>
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__text">
                            <h4>Check Out</h4>
                            <div class="breadcrumb__links">
                                <a href="./index.html">Home</a>
                                <a href="./shop.html">Shop</a>
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
                    <form action="#">
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
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
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

                                    <div class="mb-2 checkout__input__radio form-check">
                                        <input type="radio" class="form-check-input" name="payment_method"
                                            wire:model='payment_method' id="payment" value="check">
                                        <label class="form-check-label" for="payment">Check Payment</label>
                                    </div>

                                    <div class="mb-3 checkout__input__radio form-check">
                                        <input type="radio" class="form-check-input" name="payment_method"
                                            wire:model='payment_method' id="paypal" value="paypal">
                                        <label class="form-check-label" for="paypal">Paypal</label>
                                    </div>
                                    <div class="mb-3 checkout__input__radio form-check">
                                        <input type="radio" class="form-check-input" name="payment_method"
                                            wire:model='payment_method' id="visacard" value="visacard">
                                        <label class="form-check-label" for="visacard">Visa Card</label>
                                    </div>
                                    @error('payment_method')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <hr>
                                    <button wire:click.prevent="placeOrder" class="btn btn-primary btn-block" wire:loading.attr="disabled">
                                        <span wire:loading.remove>PLACE ORDER</span>
                                        <span wire:loading>Loading...</span>
                                    </button>

                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Checkout Section End -->

    </div>
