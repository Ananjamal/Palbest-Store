    {{-- In work, do what you enjoy. --}}
    <div>
        <section class="breadcrumb-option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__text">
                            <h4>Contact Us</h4>
                            <div class="breadcrumb__links">
                                <a href="{{ route('/') }}">Home</a>
                                <span>Contact Us</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Section Begin -->
        <section class="contact spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="contact__text">
                            <div class="section-title">
                                <span>Contact Information</span>
                                <h2>Contact Us</h2>
                                <p>We at PalBest are dedicated to providing high-quality clothing options. Feel free to
                                    reach out with any inquiries.</p>
                            </div>
                            <ul>
                                <li>
                                    <h4>Gaza</h4>
                                    <p>Al-Shuhada Street, Gaza City <br />+970 592766534</p>
                                </li>
                                <li>
                                    <h4>Customer Service</h4>
                                    <p>Email: support@palbest.com <br />Phone: +970 592766534</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="contact__form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Name" wire:model='name'>
                                        @error('name')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="email" placeholder="Email" wire:model='email'>
                                        @error('email')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12">
                                        <textarea placeholder="Message" wire:model='message'></textarea>
                                        @error('message')
                                            <span class="error text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                        <hr>
                                        {{-- <button type="submit" class="site-btn">Send Message</button> --}}
                                        <button wire:click="sendMessage" class="site-btn">
                                            Send Message
                                            <span wire:loading wire:target="sendMessage"
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section End -->

    </div>
