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
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="img-fluid">
                                    <span class="label">New</span>
                                    <ul class="product__hover">
                                        <li wire:click='addToFavorite({{ $item->id }})'>
                                            @if ($item->isFavorited)
                                                <i class="fa-solid fa-heart" style="color: #ff0000;"></i>
                                            @else
                                                <img src="{{ asset('assets/website/img/icon/heart.png') }}" alt="Favorite">
                                            @endif
                                        </li>
                                        <li><a href="{{ route('productDetails', $item->id) }}">
                                                <img src="{{ asset('assets/website/img/icon/search.png') }}" alt="Search"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $item->name }}</h6>
                    
                                    <!-- Display Sizes as Text -->
                                    @if (!empty(json_decode($item->size, true)))
                                        <div class="product__size__display">
                                            <strong>Sizes:</strong>
                                            <span>{{ implode(', ', json_decode($item->size)) }}</span>
                                        </div>
                                    @endif
                    
                                    <!-- Display Colors as Badges -->
                                    @if (!empty(json_decode($item->color, true)))
                                        <div class="product__color__display mb-2">
                                            <strong>Colors:</strong>
                                            @foreach (json_decode($item->color, true) as $color)
                                                <span class="color-circle" style="display:inline-block; width:15px; height:15px; background-color:{{ $color }}; border-radius:50%; margin-right:5px;"></span>
                                            @endforeach
                                        </div>
                                    @endif
                    
                                    <button wire:click='addToCart({{ $item->id }})' class="add-cart">+ Add To Cart</button>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $item->stars)
                                                <i class="fa fa-star" style="color: #ebd13f;"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <h5>${{ $item->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($hotSales as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 mix hot-sales">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="img-fluid">
                                    <span class="label">{{ $item->stock > 0 ? '' : 'out of stock' }}</span>
                                    <ul class="product__hover">
                                        <li wire:click='addToFavorite({{ $item->id }})'>
                                            @if ($item->isFavorited)
                                                <i class="fa-solid fa-heart" style="color: #ff0000;"></i>
                                            @else
                                                <img src="{{ asset('assets/website/img/icon/heart.png') }}" alt="Favorite">
                                            @endif
                                        </li>
                                        <li><a href="{{ route('productDetails', $item->id) }}">
                                                <img src="{{ asset('assets/website/img/icon/search.png') }}" alt="Search"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $item->name }}</h6>
                    
                                    <!-- Display Sizes as Text -->
                                    @if (!empty(json_decode($item->size, true)))
                                        <div class="product__size__display">
                                            <strong>Sizes:</strong>
                                            <span>{{ implode(', ', json_decode($item->size)) }}</span>
                                        </div>
                                    @endif
                    
                                    <!-- Display Colors as Badges -->
                                    @if (!empty(json_decode($item->color, true)))
                                        <div class="product__color__display mb-2">
                                            <strong>Colors:</strong>
                                            @foreach (json_decode($item->color, true) as $color)
                                                <span class="color-circle" style="display:inline-block; width:15px; height:15px; background-color:{{ $color }}; border-radius:50%; margin-right:5px;"></span>
                                            @endforeach
                                        </div>
                                    @endif
                    
                                    <button wire:click='addToCart({{ $item->id }})' class="add-cart">+ Add To Cart</button>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $item->stars)
                                                <i class="fa fa-star" style="color: #ebd13f;"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <h5>${{ $item->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    <!-- Repeat similar changes for the rest of the image paths -->

                </div>
            </div>
        </section>
    </div>
