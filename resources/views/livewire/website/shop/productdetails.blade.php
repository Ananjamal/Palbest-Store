    {{-- The best athlete wants his opponent at his best. --}}
    <div>
        <!-- Shop Details Section Begin -->
        <section class="shop-details">
            <div class="product__details__pic">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__breadcrumb">
                                <a href="{{ route('/') }}">Home</a>
                                <a href="{{ route('shop') }}">Shop</a>
                                <span>Product Details</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                            {{-- <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-1.png">
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-2.png">
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-3.png">
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-4.png">
                                            <i class="fa fa-play"></i>
                                        </div>
                                    </a>
                                </li>
                            </ul> --}}
                        </div>
                        <div class="col-lg-6 col-md-9">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product__details__content">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="product__details__text">
                                <h4>{{ $product->name }}</h4>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <span> - 5 Reviews</span>
                                </div>
                                <h3>${{ $product->price }} </h3>
                                <p>{{ $product->description }}</p>
                                <div class="product__details__last__option">
                                    <ul>
                                        <li><span>Categories:</span> {{ $product->category->name }}</li>
                                    </ul>
                                </div>
                                <div class="product__details__option">
                                    <div class="mb-4 product__details__option__size">
                                        <span>Size:</span>
                                        @foreach (json_decode($product->size, true) as $sizeOption)
                                            <label>
                                                {{ $sizeOption }}
                                                <input type="radio" name="size" value="{{ $sizeOption }}"
                                                    wire:model="size">
                                            </label>
                                        @endforeach
                                    </div>
                                    <br>

                                    <div class="product__details__option__colorfull">
                                        <span>Color:</span>
                                        {{-- @foreach (json_decode($product->color, true) as $colorOption)
                                            <label >
                                                {{ $colorOption }}

                                                <input type="radio" value="{{ $colorOption }}" wire:model="color" >
                                            </label>
                                        @endforeach --}}
                                        @foreach (json_decode($product->color, true) as $colorOption)
                                            <label for="color-{{ strtolower($colorOption) }}"
                                                style="background-color: {{ $colorOption }}; cursor: pointer; display: inline-block; border: 3px solid transparent;">
                                                <input type="radio" id="color-{{ strtolower($colorOption) }}"
                                                    name="color" value="{{ $colorOption }}" wire:model="color">
                                            </label>
                                        @endforeach
                                    </div>
                                    {{-- <div class="product__details__option__color">
                                        <span>Color:</span>
                                        @foreach (json_decode($product->color, true) as $colorOption)
                                            <label for="color-{{ strtolower($colorOption) }}"
                                                style="background-color: {{ $colorOption }}; cursor: pointer; display: inline-block; border: 3px solid transparent;">
                                                <input type="radio" id="color-{{ strtolower($colorOption) }}"
                                                    name="color" value="{{ $colorOption }}" wire:model="color"
                                                    class="color-input" style="display: none;">
                                            </label>
                                        @endforeach
                                    </div> --}}

                                </div>

                                <div class="product__details__cart__option">
                                    <span>Quantity:</span>

                                    <div class="quantity">

                                        <div class="pro-qty">

                                            <input type="text" wire:model='quantity'>
                                        </div>
                                    </div>
                                    <button wire:click='addToCart' class="primary-btn">add to cart</a>

                                </div>
                                <div class="product__details__btns__option">

                                    <a wire:click='addToFavorite'>
                                        <button class="favorite-btn">
                                            <i class="fa fa-heart"></i> add to wishlist
                                        </button>
                                    </a>
                                </div>
                                <div class="product__details__last__option">
                                    <h5><span>Guaranteed Safe Checkout</span></h5>
                                    <img src="{{ asset('assets/website/img/shop-details/details-payment.png') }}"
                                        alt="">
                                    <ul>
                                        {{-- <li><span>Categories:</span> {{ $product->category->name }}</li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="product__details__tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                        information</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                        <div class="product__details__tab__content">
                                            <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                                solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                                ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                            <div class="product__details__tab__content__item">
                                                <h5>Products Infomation</h5>
                                                <p>A Pocket PC is a handheld computer, which features many of the same
                                                    capabilities as a modern PC. These handy little devices allow
                                                    individuals to retrieve and store e-mail messages, create a contact
                                                    file, coordinate appointments, surf the internet, exchange text messages
                                                    and more. Every product that is labeled as a Pocket PC must be
                                                    accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                                <p>As is the case with any new technology product, the cost of a Pocket PC
                                                    was substantial during it’s early release. For approximately $700.00,
                                                    consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                    These days, customers are finding that prices have become much more
                                                    reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                            </div>
                                            <div class="product__details__tab__content__item">
                                                <h5>Material used</h5>
                                                <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                    from synthetic materials, not natural like wool. Polyester suits become
                                                    creased easily and are known for not being breathable. Polyester suits
                                                    tend to have a shine to them compared to wool and cotton suits, this can
                                                    make the suit look cheap. The texture of velvet is luxurious and
                                                    breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-6" role="tabpanel">
                                        <div class="product__details__tab__content">
                                            <div class="product__details__tab__content__item">
                                                <h5>Products Infomation</h5>
                                                <p>A Pocket PC is a handheld computer, which features many of the same
                                                    capabilities as a modern PC. These handy little devices allow
                                                    individuals to retrieve and store e-mail messages, create a contact
                                                    file, coordinate appointments, surf the internet, exchange text messages
                                                    and more. Every product that is labeled as a Pocket PC must be
                                                    accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                                <p>As is the case with any new technology product, the cost of a Pocket PC
                                                    was substantial during it’s early release. For approximately $700.00,
                                                    consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                    These days, customers are finding that prices have become much more
                                                    reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                            </div>
                                            <div class="product__details__tab__content__item">
                                                <h5>Material used</h5>
                                                <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                    from synthetic materials, not natural like wool. Polyester suits become
                                                    creased easily and are known for not being breathable. Polyester suits
                                                    tend to have a shine to them compared to wool and cotton suits, this can
                                                    make the suit look cheap. The texture of velvet is luxurious and
                                                    breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-7" role="tabpanel">
                                        <div class="product__details__tab__content">
                                            <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                                solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                                ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                            <div class="product__details__tab__content__item">
                                                <h5>Products Infomation</h5>
                                                <p>A Pocket PC is a handheld computer, which features many of the same
                                                    capabilities as a modern PC. These handy little devices allow
                                                    individuals to retrieve and store e-mail messages, create a contact
                                                    file, coordinate appointments, surf the internet, exchange text messages
                                                    and more. Every product that is labeled as a Pocket PC must be
                                                    accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                                <p>As is the case with any new technology product, the cost of a Pocket PC
                                                    was substantial during it’s early release. For approximately $700.00,
                                                    consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                    These days, customers are finding that prices have become much more
                                                    reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                            </div>
                                            <div class="product__details__tab__content__item">
                                                <h5>Material used</h5>
                                                <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                    from synthetic materials, not natural like wool. Polyester suits become
                                                    creased easily and are known for not being breathable. Polyester suits
                                                    tend to have a shine to them compared to wool and cotton suits, this can
                                                    make the suit look cheap. The texture of velvet is luxurious and
                                                    breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- Shop Details Section End -->
    </div>
