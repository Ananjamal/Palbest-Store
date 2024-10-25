    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div>
        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__text">
                            <h4>Shopping Cart</h4>
                            <div class="breadcrumb__links">
                                <a href="./index.html">Home</a>
                                <a href="./shop.html">Shop</a>
                                <span>Shopping Cart</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Breadcrumb Section End -->
        <!-- Shopping Cart Section Begin -->
        <section class="shopping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="d-flex align-items-center">
                                                    <div class="product__cart__item__pic">
                                                        <img src="{{ Storage::url($item->product->image) }}"
                                                            alt="{{ $item->product->name }}" height="120"
                                                            width="120" class="rounded img-fluid">
                                                    </div>
                                                    <div class="pl-3 product__cart__item__text">
                                                        <h6>{{ $item->product->name }}</h6>
                                                        <span>Price:
                                                            ${{ number_format($item->product->price, 2) }}</span><br>
                                                        <span>Size: {{ $item->size }}</span><br>
                                                        <span>Color: {{ $item->color }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity d-flex align-items-center">
                                                    <button class="btn btn-outline-secondary"
                                                        wire:click='decreaseQty({{ $item->id }})'>-</button>
                                                    <input type="text" value="{{ $item->quantity }}"
                                                        class="mx-2 text-center form-control" style="width: 50px;"
                                                        readonly>
                                                    <button class="btn btn-outline-secondary"
                                                        wire:click='increaseQty({{ $item->id }})'>+</button>
                                                </div>
                                            </td>

                                            <td class="cart__price">
                                                $<span>{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                            </td>
                                            <td class="cart__close">
                                                <i wire:click='deleteFromCart({{ $item->id }})'
                                                    class="fa fa-close text-danger" style="cursor: pointer;"></i>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            @if (count($cartItems) === 0)
                                <div class="mt-4 text-center alert alert-info">
                                    Your wishlist is empty.
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="{{ route('shop') }}">Continue Shopping</a>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cart__discount">
                            <h6>Discount Codes</h6>
                            <div class="cart__discount-container">
                                <input type="text" wire:model='coupon_code' placeholder="Enter coupon code">
                                <button wire:click='applyCoupon'>Apply</button>
                            </div>
                        </div>

                        <div class="cart__total">
                            <h6>Cart total</h6>
                            <ul>
                                <li>Subtotal <span>${{ number_format($subTotal, 2) }}</span></li>
                                <li>Discount <span>${{ number_format($discount, 2) }}</span></li>
                                <li>Total <span>${{ number_format($totalPrice, 2) }}</span></li>
                            </ul>

                            <button wire:click='sendDataToCheckout' class="btn btn-dark btn-lg btn-block checkout-btn">
                                Proceed to checkout
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Shopping Cart Section End -->

    </div>
