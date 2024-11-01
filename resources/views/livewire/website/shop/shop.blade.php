    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
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
                            <div class="shop__sidebar__search">
                                <form wire:submit.prevent="loadProducts">
                                    <input type="text" wire:model.lazy="searchTerm"
                                        wire:input="setSearchTerm($event.target.value)"
                                        placeholder="Search products...">
                                    <button type="submit"><span class="icon_search"></span></button>
                                </form>
                            </div>
                            <div class="shop__sidebar__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__categories">
                                                    <ul class="nice-scroll">
                                                            @foreach ($categories as $category)
                                                                <li>
                                                                    <a href="#" wire:click.prevent="setCategory({{ $category->id }})">
                                                                        {{ $category->name }} ({{ $category->products_count }}) <!-- Display product count -->
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                        </div>
                                        <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__price">
                                                    <ul>
                                                        <li><a href="#"
                                                                wire:click.prevent="selectPriceRange('0-50')">$0 - $50</a>
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
                                                                wire:click.prevent="selectPriceRange('250+')">$250+</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseFive">Sizes</a>
                                        </div>
                                        <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__sizes">
                                                    @foreach ($sizes as $size)
                                                        <label>
                                                            <input type="radio" wire:model="selectedSize"
                                                                value="{{ $size }}"
                                                                wire:click="selectSize('{{ $size }}')">
                                                            {{ strtoupper($size) }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseSix">Colors</a>
                                        </div>
                                        <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__colors">
                                                    @foreach ($colors as $color)
                                                        <label>
                                                            <input type="radio" wire:model="selectedColor"
                                                                value="{{ $color }}"
                                                                wire:click="selectColor('{{ $color }}')">
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


                    </div>
                    <div class="col-lg-9">
                        {{-- <div class="shop__product__option">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="shop__product__option__left">
                                        <p>Showing 1–12 of 126 results</p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="shop__product__option__right">
                                        <p>Sort by Price:</p>
                                        <select>
                                            <option value="">Low To High</option>
                                            <option value="">$0 - $55</option>
                                            <option value="">$55 - $100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            @if ($products->isEmpty())
                                <div style="text-align: center; padding: 20px; color: #555;">
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

                                                <button wire:click='addToCart({{ $item->id }})'
                                                    class="add-cart">+
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



                            {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">
                                        <span class="label">Sale</span>
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Multi-pocket Chest Bag</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$43.48</h5>
                                        <div class="product__color__select">
                                            <label for="pc-7">
                                                <input type="radio" id="pc-7">
                                            </label>
                                            <label class="active black" for="pc-8">
                                                <input type="radio" id="pc-8">
                                            </label>
                                            <label class="grey" for="pc-9">
                                                <input type="radio" id="pc-9">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Diagonal Textured Cap</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$60.9</h5>
                                        <div class="product__color__select">
                                            <label for="pc-10">
                                                <input type="radio" id="pc-10">
                                            </label>
                                            <label class="active black" for="pc-11">
                                                <input type="radio" id="pc-11">
                                            </label>
                                            <label class="grey" for="pc-12">
                                                <input type="radio" id="pc-12">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-6.jpg">
                                        <span class="label">Sale</span>
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Ankle Boots</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$98.49</h5>
                                        <div class="product__color__select">
                                            <label for="pc-16">
                                                <input type="radio" id="pc-16">
                                            </label>
                                            <label class="active black" for="pc-17">
                                                <input type="radio" id="pc-17">
                                            </label>
                                            <label class="grey" for="pc-18">
                                                <input type="radio" id="pc-18">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>T-shirt Contrast Pocket</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$49.66</h5>
                                        <div class="product__color__select">
                                            <label for="pc-19">
                                                <input type="radio" id="pc-19">
                                            </label>
                                            <label class="active black" for="pc-20">
                                                <input type="radio" id="pc-20">
                                            </label>
                                            <label class="grey" for="pc-21">
                                                <input type="radio" id="pc-21">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-8.jpg">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Basic Flowing Scarf</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$26.28</h5>
                                        <div class="product__color__select">
                                            <label for="pc-22">
                                                <input type="radio" id="pc-22">
                                            </label>
                                            <label class="active black" for="pc-23">
                                                <input type="radio" id="pc-23">
                                            </label>
                                            <label class="grey" for="pc-24">
                                                <input type="radio" id="pc-24">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-9.jpg">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Piqué Biker Jacket</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$67.24</h5>
                                        <div class="product__color__select">
                                            <label for="pc-25">
                                                <input type="radio" id="pc-25">
                                            </label>
                                            <label class="active black" for="pc-26">
                                                <input type="radio" id="pc-26">
                                            </label>
                                            <label class="grey" for="pc-27">
                                                <input type="radio" id="pc-27">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-10.jpg">
                                        <span class="label">Sale</span>
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Multi-pocket Chest Bag</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$43.48</h5>
                                        <div class="product__color__select">
                                            <label for="pc-28">
                                                <input type="radio" id="pc-28">
                                            </label>
                                            <label class="active black" for="pc-29">
                                                <input type="radio" id="pc-29">
                                            </label>
                                            <label class="grey" for="pc-30">
                                                <input type="radio" id="pc-30">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-11.jpg">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Diagonal Textured Cap</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$60.9</h5>
                                        <div class="product__color__select">
                                            <label for="pc-31">
                                                <input type="radio" id="pc-31">
                                            </label>
                                            <label class="active black" for="pc-32">
                                                <input type="radio" id="pc-32">
                                            </label>
                                            <label class="grey" for="pc-33">
                                                <input type="radio" id="pc-33">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-12.jpg">
                                        <span class="label">Sale</span>
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Ankle Boots</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$98.49</h5>
                                        <div class="product__color__select">
                                            <label for="pc-34">
                                                <input type="radio" id="pc-34">
                                            </label>
                                            <label class="active black" for="pc-35">
                                                <input type="radio" id="pc-35">
                                            </label>
                                            <label class="grey" for="pc-36">
                                                <input type="radio" id="pc-36">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-13.jpg">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>T-shirt Contrast Pocket</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$49.66</h5>
                                        <div class="product__color__select">
                                            <label for="pc-37">
                                                <input type="radio" id="pc-37">
                                            </label>
                                            <label class="active black" for="pc-38">
                                                <input type="radio" id="pc-38">
                                            </label>
                                            <label class="grey" for="pc-39">
                                                <input type="radio" id="pc-39">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/product/product-14.jpg">
                                        <ul class="product__hover">
                                            <li><a href="#"><img src="img/icon/heart.png" alt=""></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6>Basic Flowing Scarf</h6>
                                        <a href="#" class="add-cart">+ Add To Cart</a>
                                        <div class="rating">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <h5>$26.28</h5>
                                        <div class="product__color__select">
                                            <label for="pc-40">
                                                <input type="radio" id="pc-40">
                                            </label>
                                            <label class="active black" for="pc-41">
                                                <input type="radio" id="pc-41">
                                            </label>
                                            <label class="grey" for="pc-42">
                                                <input type="radio" id="pc-42">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product__pagination">
                                    <a class="active" href="#">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <span>...</span>
                                    <a href="#">21</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shop Section End -->

    </div>
