    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div>
        <section class="product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="filter__controls">
                            <li class="active" data-filter="*">Best Sellers</li>
                            <li data-filter=".new-arrivals">New Arrivals</li>
                            <li data-filter=".hot-sales">Hot Sales</li>
                        </ul>
                    </div>
                </div>
                <div class="row product__filter">
                    @foreach ($newArrivals as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 mix new-arrivals">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    <!-- Use an <img> tag for the product image -->
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}"
                                        class="img-fluid">
                                    <span class="label">New</span>
                                    <ul class="product__hover">
                                        <li wire:click='addToFavorite({{ $item->id }})'>
                                            @if ($item->isFavorited)
                                                <i class="fa-solid fa-heart" style="color: #ff0000;"></i>
                                            @else
                                                <img src="{{ asset('assets/website/img/icon/heart.png') }}"
                                                    alt="Favorite">
                                            @endif

                                        </li>
                                        <li><a href="{{ route('productDetails', $item->id) }}">
                                                <img src="{{ asset('assets/website/img/icon/search.png') }}"
                                                    alt="Search"></a>
                                        </li>
                                        {{-- <li wire:click='addToCart({{ $item->id }})'>
                                            <i class="fa-solid fa-cart-plus" style="color: #000000"></i>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $item->name }}</h6>
                                    <button wire:click='addToCart({{ $item->id }})' class="add-cart">+ Add To
                                        Cart</button>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $item->stars)
                                                <i class="fa fa-star" style="color: #ebd13f;"></i>
                                                <!-- Filled yellow star -->
                                            @else
                                                <i class="fa fa-star-o"></i> <!-- Empty star -->
                                            @endif
                                        @endfor
                                    </div>
                                    <h5>${{ $item->price }}</h5>
                                    {{-- <div class="product__color__select">
                                        <label for="pc-1">
                                            <input type="radio" id="pc-1">
                                        </label>
                                        <label class="active black" for="pc-2">
                                            <input type="radio" id="pc-2">
                                        </label>
                                        <label class="grey" for="pc-3">
                                            <input type="radio" id="pc-3">
                                        </label>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($hotSales as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 mix hot-sales">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    <!-- Use an <img> tag for the product image -->
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}"
                                        class="img-fluid">
                                    <ul class="product__hover">
                                        <li wire:click='addToFavorite({{ $item->id }})'>
                                            @if ($item->isFavorited)
                                                <i class="fa-solid fa-heart" style="color: #ff0000;"></i>
                                            @else
                                                <img src="{{ asset('assets/website/img/icon/heart.png') }}"
                                                    alt="Favorite">
                                            @endif
                                        </li>
                                        <li><a href="{{ route('productDetails', $item->id) }}">
                                                <img src="{{ asset('assets/website/img/icon/search.png') }}"
                                                    alt="Search"></a>
                                        </li>
                                        {{-- <li wire:click='addToCart({{ $item->id }})'>
                                            <i class="fa-solid fa-cart-plus" style="color: #000000"></i>
                                        </li> --}}

                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $item->name }}</h6>
                                    <button wire:click='addToCart({{ $item->id }})'>+ Add To Cart</button>

                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $item->stars)
                                                <i class="fa fa-star" style="color: #ebd13f;"></i>
                                                <!-- Filled yellow star -->
                                            @else
                                                <i class="fa fa-star-o"></i> <!-- Empty star -->
                                            @endif
                                        @endfor
                                    </div>
                                    <h5>${{ $item->price }}</h5>
                                    {{-- <div class="product__color__select">
                                        <label for="pc-1">
                                            <input type="radio" id="pc-1">
                                        </label>
                                        <label class="active black" for="pc-2">
                                            <input type="radio" id="pc-2">
                                        </label>
                                        <label class="grey" for="pc-3">
                                            <input type="radio" id="pc-3">
                                        </label>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    @endforeach


                    <!-- Repeat similar changes for the rest of the image paths -->

                </div>
            </div>
        </section>
    </div>
