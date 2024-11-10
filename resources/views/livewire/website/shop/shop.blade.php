<div>
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('/') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="sidebar-search">
                            <form wire:submit.prevent="loadProducts">
                                <input type="text" wire:model.lazy="searchTerm"
                                    wire:input="setSearchTerm($event.target.value)" placeholder="Search products...">
                                <button type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>

                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card custom-card">
                                    <div class="card-heading custom-card-heading">Categories</div>
                                    <div class="card-body custom-card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <a href="#"
                                                            wire:click.prevent="setCategory({{ $category->id }})">
                                                            {{ $category->name }}
                                                        </a>
                                                    </li>
                                                    {{-- ({{ $category->products_count }}) --}}
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card custom-card">
                                    <div class="card-heading custom-card-heading">Filter Price</div>
                                    <div class="card-body custom-card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="#" wire:click.prevent="selectPriceRange('0-50')">$0 -
                                                        $50</a>
                                                </li>
                                                <li><a href="#"
                                                        wire:click.prevent="selectPriceRange('50-100')">$50 -
                                                        $100</a></li>
                                                <li><a href="#"
                                                        wire:click.prevent="selectPriceRange('100-150')">$100 -
                                                        $150</a></li>
                                                <li><a href="#"
                                                        wire:click.prevent="selectPriceRange('150-200')">$150 -
                                                        $200</a></li>
                                                <li><a href="#"
                                                        wire:click.prevent="selectPriceRange('200-250')">$200 -
                                                        $250</a></li>
                                                <li><a href="#"
                                                        wire:click.prevent="selectPriceRange('250+')">$250+</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card custom-card">
                                    <div class="card-heading custom-card-heading">Sizes</div>
                                    <div class="card-body custom-card-body">
                                        <div class="shop__sidebar__sizes">
                                            @foreach ($sizes as $size)
                                                <label class="custom-label">
                                                    <input type="radio" wire:model="selectedSize"
                                                        value="{{ $size }}"
                                                        wire:click="selectSize('{{ $size }}')">
                                                    {{ strtoupper($size) }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="card custom-card">
                                    <div class="card-heading custom-card-heading">Colors</div>

                                    <div class="card-body custom-card-body" style="padding: 20px;">
                                        <div class="shop__sidebar__colors" style="display: flex; flex-wrap: wrap; margin-left: 20px;">
                                            @foreach ($colors as $color)
                                                <label class="custom-label"
                                                    style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px; margin-bottom: 10px; padding: 10px; border-radius: 100px; cursor: pointer; transition: background-color 0.3s ease; width: 80px; height: 40px; color: white; font-size: 0.9rem; background-color: {{ $color }};"
                                                    onmouseover="this.style.filter = 'brightness(85%)';"
                                                    onmouseout="this.style.filter = 'brightness(100%)';">
                                                    <input type="radio" wire:model="selectedColor"
                                                        value="{{ $color }}"
                                                        wire:click="selectColor('{{ $color }}')"
                                                        style="display: none;">
                                                    {{ ucfirst($color) }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">

                    <div class="row">
                        @if ($products->isEmpty())
                            <div style="text-align: center;margin-top:150px; padding: 20px; color: #555;">
                                <h3>No Products Found</h3>
                            </div>
                        @else
                            @foreach ($products as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic">
                                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}"
                                                class="img-fluid">
                                            @if ($item->inventory->stock == 0)
                                                <span class="label">out of stock</span>
                                            @endif

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
                                                <div class="mb-2 product__color__display">
                                                    <strong>Colors:</strong>
                                                    @foreach (json_decode($item->color, true) as $color)
                                                        <span class="color-circle"
                                                            style="display:inline-block; width:15px; height:15px; background-color:{{ $color }}; border-radius:50%; margin-right:5px;"></span>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <button wire:click='addToCart({{ $item->id }})' class="add-cart">+
                                                Add To Cart</button>
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
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{ $products->links() }}

                            {{-- <div class="product__pagination">
                                <a class="active" href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <span>...</span>
                                <a href="#">21</a>

                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

</div>
