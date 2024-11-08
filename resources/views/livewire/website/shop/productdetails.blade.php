    <div>
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
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <i class="fa fa-star" style="color: #ebd13f;"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                    <span> - {{$review_count}} Reviews</span>

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
                                <div class="user-rating">
                                    <label for="user-rating" class="rating-label">Rate this product:</label>
                                    <div class="rating-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star" 
                                        wire:click="setUserRating({{ $i }})" 
                                        wire:mouseenter="setHoveredRating({{ $i }})"
                                        wire:mouseleave="resetHoveredRating"
                                        style="cursor: pointer; color: {{ $i <= ($hoveredRating ?: $userRating) ? '#ebd13f' : '#ccc' }};" 
                                        title="Rating {{ $i }}"></i>
                                     
                                        @endfor
                                    </div>
                                    <button wire:click="submitRating" class="btn-submit-rating mt-2">Submit Rating</button>
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
                  
                </div>
            </div>
        </section>
        <!-- Shop Details Section End -->
    </div>
