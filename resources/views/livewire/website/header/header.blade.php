<div>
    <header class="header">
        <div class="container">
            <div class="header__content">
                <!-- Logo -->
                <div class="header__logo">
                    <a href="{{ route('/') }}"><img src="{{ asset('assets/website/img/logo.png') }}" alt="Logo"></a>
                </div>

                <!-- Navigation Menu -->
                <nav class="header__menu">
                    <ul>
                        <li><a href="{{ route('/') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                    </ul>
                </nav>

                <!-- User Actions -->
                <div class="header__actions">
                    <a href="#" class="icon-link " data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fa fa-search"></i>
                    </a>
                    <a href="{{ route('favorites') }}" class="icon-link">
                        <i class="fa fa-heart"></i>
                        @auth
                            <span class="badge">{{ $favoriteCount }}</span>
                        @endauth
                    </a>
                    <a href="{{ route('cart') }}" class="icon-link cart-icon">
                        <i class="fa fa-shopping-cart"></i>
                        @auth
                            <span class="badge">{{ $cartCount }}</span>
                        @endauth
                    </a>

                    @auth
                        <a href="{{ route('orders') }}" class="icon-link">
                            <i class="fa-solid fa-truck"></i>
                            @auth
                                <span class="badge">{{ $ordersCount }}</span>
                            @endauth
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Profile</a>
                        @role('admin')
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">Dashboard</a>
                        @endrole
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Sign up</a>
                        @endif
                    @endauth
                </div>

                <!-- Mobile Menu Icon -->
                <div class="canvas__open d-lg-none">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Search</h5>
                        <button type="button" wire:click='clearSearch' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Search Form -->
                        <form wire:submit.prevent="loadProducts" class="d-flex align-items-center mb-3">
                            <input type="text" wire:model.lazy="searchTerm"
                                wire:input="setSearchTerm($event.target.value)" placeholder="Search products..."
                                class="form-control me-2" aria-label="Search products">
                            <button type="submit" class="btn btn-primary">
                                <span class="icon_search"></span>
                            </button>
                        </form>

                        <!-- Display search results -->
                        <div class="search-results">
                            @if (count($results) > 0)
                            <ul class="list-group">
                                @foreach ($results as $product)
                                    <li class="list-group-item d-flex align-items-center border-0 shadow-sm mb-2 rounded">
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                             class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem;">
                                        <div class="flex-grow-1">
                                            <a href="{{ route('productDetails', $product['id']) }}" class="text-decoration-none text-dark">
                                                <h6 class="mb-0">{{ $product['name'] }}</h6>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            @else
                                <p class="text-muted">No results found.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- Search Modal -->
    <!-- Search Modal -->



    {{-- <!-- Trigger search modal with search icon -->
<a href="#" class="icon-link" data-bs-toggle="modal" data-bs-target="#searchModal">
    <i class="fa fa-search"></i>
</a> --}}
</div>
