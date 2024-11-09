<div>
    <footer class="py-5 text-white bg-black footer">
        <div class="container">
            <div class="row justify-content-between">
                <!-- About Section -->
                <div class="mb-4 col-lg-3 col-md-6">
                    <div class="footer__about">
                        <div class="mb-3 footer__logo">
                            <a href="#"><img src="{{ asset('assets/website/img/footer-logo.png') }}" alt="PalBest Logo" class="img-fluid"></a>
                        </div>
                        <p class="footer__about-text">Your style, our passion! PalBest brings you the finest clothing designed to make you feel confident, comfortable, and unique.</p>
                        <a href="#"><img src="{{ asset('assets/website/img/payment.png') }}" alt="Payment Methods" class="mt-3 img-fluid"></a>
                    </div>
                </div>

                <!-- Shopping Section -->
                <div class="mb-4 col-lg-2 col-md-3">
                    <div class="footer__widget">
                        <h6 class="footer__heading">Shopping</h6>
                        <ul class="footer__list">
                            <li><a href="{{route('shop')}}">New Arrivals</a></li>
                            <li><a href="{{route('shop')}}">Trending Styles</a></li>
                            <li><a href="{{route('shop')}}">Accessories</a></li>
                            <li><a href="{{route('shop')}}">Exclusive Offers</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Newsletter Section -->
                <div class="mb-4 col-lg-3 col-md-6">
                    <div class="footer__widget">
                        <h6 class="footer__heading">Newsletter</h6>
                        <div class="footer__newsletter">
                            <p class="footer__newsletter-text">Stay ahead of the trends! Get updates on new collections, special offers, and exclusive deals.</p>
                            <form class="newsletter-form">
                                <input type="text" wire:model='message' class="footer__newsletter-input" placeholder="Enter your message">
                                <button wire:click='sendMessage' class="footer__newsletter-button"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Copyright -->
            <div class="mt-4 row justify-content-center">
                <div class="text-center col-lg-12">
                    <div class="footer__copyright">
                        <p>&copy; {{now()->year}} PalBest Clothing. All rights reserved. <i class="icon_heart"></i> by <a href="{{route('/')}}">PalBest</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
