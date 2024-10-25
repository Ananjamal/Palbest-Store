<div>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Wishlist</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('/') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Wishlist Section Begin -->
    <!-- Wishlist Section Begin -->
    <section class="py-5 wishlist spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="p-4 text-center bg-white rounded shadow-sm wishlist__table">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="text-center text-uppercase text-muted border-bottom">
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favoriteItems as $item)
                                    <tr class="text-center align-middle border-bottom">
                                        <td
                                            class="product__wishlist__item d-flex align-items-center justify-content-center">
                                            <div class="mr-3 product__wishlist__item__pic">
                                                <img src="{{ Storage::url($item->product->image) }}"
                                                    alt="{{ $item->product->name }}" class="rounded img-fluid"
                                                    style="height: 80px; width: 80px; object-fit: cover;">
                                            </div>
                                            <div class="text-center product__wishlist__item__text">
                                                <h6 class="mb-1 font-weight-bold">{{ $item->product->name }}</h6>
                                                {{-- <p class="mb-0 text-muted small">Price: ${{ number_format($item->product->price, 2) }}</p> --}}

                                            </div>
                                        </td>
                                        <td class="text-center align-middle cart__price">
                                            <strong>${{ number_format($item->product->price, 2) }}</strong>
                                        </td>
                                        <td class="text-center align-middle wishlist__actions">
                                            <!-- Button to show details -->
                                            <button class="px-3 btn btn-sm btn-outline-success">
                                                <a href="{{ route('productDetails', $item->product->id) }}">
                                                    <i class="fa fa-info-circle"></i> Details
                                                </a>
                                            </button>

                                            <!-- Button to remove from wishlist -->
                                            <button class="px-3 btn btn-sm btn-outline-danger"
                                                wire:click="removeFromWishlist({{ $item->id }})">
                                                <i class="fa fa-trash"></i> Remove
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if (count($favoriteItems) === 0)
                            <div class="mt-4 text-center alert alert-info">
                                Your wishlist is empty. <a href="{{ route('shop') }}" class="text-primary">Continue
                                    shopping</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wishlist Section End -->
</div>
