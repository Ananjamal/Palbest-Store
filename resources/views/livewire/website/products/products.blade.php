 {{-- resources/views/livewire/website/products/products.blade.php --}}
<div>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="{{ $categoryFilter === 'best_sellers' ? 'active' : '' }} filter-button"
                            wire:click="$set('categoryFilter', 'best_sellers')">
                            Best Sellers
                        </li>
                        <li class="{{ $categoryFilter === 'new_arrivals' ? 'active' : '' }} filter-button"
                            wire:click="$set('categoryFilter', 'new_arrivals')">
                            New Arrivals
                        </li>
                        <li class="{{ $categoryFilter === 'hot_sales' ? 'active' : '' }} filter-button"
                            wire:click="$set('categoryFilter', 'hot_sales')">
                            Hot Sales
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row product__filter">
                {{-- Best Sellers: Merging Hot Sales and New Arrivals --}}
                @if ($categoryFilter === 'best_sellers')
                    @foreach ($hotSales->merge($newArrivals) as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 mix best-sellers fade-in">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="img-fluid">
                                    {{-- Out of Stock Label --}}
                                    @if ($item->inventory->stock == 0)
                                        <span class="label">Out of Stock</span>
                                    @elseif ($hotSales->contains($item))
                                        <span class="label">Hot</span>
                                    @else
                                        <span class="label">New</span>
                                    @endif
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
                                    @if (!empty(json_decode($item->size, true)))
                                        <div class="product__size__display">
                                            <strong>Sizes:</strong>
                                            <span>{{ implode(', ', json_decode($item->size)) }}</span>
                                        </div>
                                    @endif
                                    @if (!empty(json_decode($item->color, true)))
                                        <div class="mb-2 product__color__display">
                                            <strong>Colors:</strong>
                                            @foreach (json_decode($item->color, true) as $color)
                                                <span class="color-circle" style="background-color: {{ $color }};"></span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <button wire:click='addToCart({{ $item->id }})' class="add-cart">+ Add To Cart</button>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa {{ $i <= $item->stars ? 'fa-star' : 'fa-star-o' }}" style="color: #ebd13f;"></i>
                                        @endfor
                                    </div>
                                    <h5>${{ $item->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                {{-- New Arrivals Category --}}
                @elseif ($categoryFilter === 'new_arrivals')
                    @foreach ($newArrivals as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 mix new-arrivals fade-in">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="img-fluid">
                                    {{-- Out of Stock Label --}}
                                    @if ($item->inventory->stock == 0)
                                        <span class="label">Out of Stock</span>
                                    @else
                                        <span class="label">New</span>
                                    @endif
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
                                    @if (!empty(json_decode($item->size, true)))
                                        <div class="product__size__display">
                                            <strong>Sizes:</strong>
                                            <span>{{ implode(', ', json_decode($item->size)) }}</span>
                                        </div>
                                    @endif
                                    @if (!empty(json_decode($item->color, true)))
                                        <div class="mb-2 product__color__display">
                                            <strong>Colors:</strong>
                                            @foreach (json_decode($item->color, true) as $color)
                                                <span class="color-circle" style="background-color: {{ $color }};"></span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <button wire:click='addToCart({{ $item->id }})' class="add-cart">+ Add To Cart</button>
                                    <div class="rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa {{ $i <= $item->stars ? 'fa-star' : 'fa-star-o' }}" style="color: #ebd13f;"></i>
                                        @endfor
                                    </div>
                                    <h5>${{ $item->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach

                {{-- Hot Sales Category --}}
                @elseif ($categoryFilter === 'hot_sales')
                    @foreach ($hotSales as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 mix hot-sales fade-in">
                            <div class="product__item">
                                <div class="product__item__pic">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}" class="img-fluid">
                                    {{-- Out of Stock Label --}}
                                    @if ($item->inventory->stock == 0)
                                        <span class="label">Out of Stock</span>
                                    @else
                                        <span class="label">Hot</span>
                                    @endif
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
                                    @if (!empty(json_decode($item->size, true)))
                                        <div class="product__size__display">
                                            <strong>Sizes:</strong>
                                            <span>{{ implode(', ', json_decode($item->size)) }}</span>
                                        </div>
                                    @endif
                                    @if (!empty(json_decode($item->color, true)))
                                        <div class="mb-2 product__color__display">
                                            <strong>Colors:</strong>
                                            @foreach (json_decode($item->color, true) as $color)
                                                <span class="color-circle" style="background-color: {{ $color }};"></span>
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
                @else
                    <div class="text-center col-12">Please select a filter to view products.</div>
                @endif
            </div>
        </div>
    </section>
</div>

