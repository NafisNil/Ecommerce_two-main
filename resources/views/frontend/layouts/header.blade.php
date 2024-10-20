
    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-6">
                    <div class="welcome-note">
                        <span class="popover--text" data-toggle="popover" data-content="Welcome to Bigshop ecommerce template."><i class="icofont-info-square"></i></span>
                        <span class="text">Welcome to Bigshop ecommerce template.</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="language-currency-dropdown d-flex align-items-center justify-content-end">
                        <!-- Language Dropdown -->
                        <div class="language-dropdown">
                            <div class="dropdown">
                                <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    English
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#">Bangla</a>
                                    <a class="dropdown-item" href="#">Arabic</a>
                                </div>
                            </div>
                        </div>
                        <!-- Currency Dropdown -->
                        <div class="currency-dropdown">
                            <div class="dropdown">
                                <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    $ USD
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <a class="dropdown-item" href="#">৳ BDT</a>
                                    <a class="dropdown-item" href="#">€ Euro</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu -->
    <div class="bigshop-main-menu">
        <div class="container">
            <div class="classy-nav-container breakpoint-off">
                <nav class="classy-navbar" id="bigshopNav">
                    <!-- Nav Brand -->
                    <a href="{{ route('index') }}" class="nav-brand"><img src="{{ asset('frontend') }}/bigshop-2.3.0/img/core-img/logo.png" alt="logo"></a>
                    <!-- Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>
                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Close -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{ route('index') }}">Home</a>
                                    
                                </li>
                                <li><a href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li><a href="#">Pages</a>
                                    <div class="megamenu">
                                        <ul class="single-mega cn-col-4">
                                            <li><a href="bigshop-2.3.0/about-us.html">- About Us</a></li>
                                            <li><a href="bigshop-2.3.0/faq.html">- FAQ</a></li>
                                            <li><a href="bigshop-2.3.0/contact.html">- Contact</a></li>
                                            <li><a href="bigshop-2.3.0/login.html">- Login & Register</a></li>
                                            <li><a href="bigshop-2.3.0/404.html">- 404</a></li>
                                            <li><a href="bigshop-2.3.0/500.html">- 500</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li><a href="bigshop-2.3.0/my-account.html">- Dashboard</a></li>
                                            <li><a href="bigshop-2.3.0/order-list.html">- Orders</a></li>
                                            <li><a href="bigshop-2.3.0/downloads.html">- Downloads</a></li>
                                            <li><a href="bigshop-2.3.0/addresses.html">- Addresses</a></li>
                                            <li><a href="bigshop-2.3.0/account-details.html">- Account Details</a></li>
                                            <li><a href="bigshop-2.3.0/coming-soon.html">- Coming Soon</a></li>
                                        </ul>
                                        <div class="single-mega cn-col-2">
                                            <div class="megamenu-slides owl-carousel">
                                                <a href="bigshop-2.3.0/shop-grid-left-sidebar.html">
                                                    <img src="bigshop-2.3.0/img/bg-img/mega-slide-2.jpg" alt="">
                                                </a>
                                                <a href="bigshop-2.3.0/shop-list-left-sidebar.html">
                                                    <img src="bigshop-2.3.0/img/bg-img/mega-slide-1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">Blog</a>
                                    <ul class="dropdown">
                                        <li><a href="bigshop-2.3.0/blog-with-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a href="bigshop-2.3.0/blog-with-right-sidebar.html">Blog Right Sidebar</a></li>
                                        <li><a href="bigshop-2.3.0/blog-with-no-sidebar.html">Blog No Sidebar</a></li>
                                        <li><a href="bigshop-2.3.0/single-blog.html">Single Blog</a></li>
                                    </ul>
                                </li>

                                <li><a href="bigshop-2.3.0/contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Hero Meta -->
                    <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end">
                        <!-- Search -->
                        <div class="search-area">
                            <div class="search-btn"><i class="icofont-search"></i></div>
                            <!-- Form -->
                            <div class="search-form">
                                <input type="search" class="form-control" placeholder="Search">
                                <input type="submit" class="d-none" value="Send">
                            </div>
                        </div>
                        <!-- Wishlist -->
                        <div class="wishlist-area">
                            <a href="{{ route('wishlist') }}" class="wishlist-btn" id='wishlist_counter'><i class="icofont-heart">{{ Cart::instance('wishlist')->count() }}</i></a>
                        </div>
                        <!-- Cart -->
                        <div class="cart-area">
                            <div class="cart--btn"><i class="icofont-cart"></i> <span class="cart_quantity" id="cart-counter">{{ Cart::instance('shopping')->count() }}</span></div>
                            <!-- Cart Dropdown Content -->
                            <div class="cart-dropdown-content">
                                <ul class="cart-list">
                                    @foreach (Cart::instance('shopping')->content() as $item)
                                    <li>
                                        <div class="cart-item-desc">
                                            <a href="#" class="image">
                                                <img src="{{ $item->model->photo }}" class="cart-thumb" alt="">
                                            </a>
                                            <div>
                                                <a href="{{ route('product.details', $item->model->slug) }}">{{ $item->name }}</a>
                                                <p>{{ $item->qty }} - <span class="price">${{ number_format($item->price, 2) }}</span></p>
                                            </div>
                                        </div>
                                        <span class="dropdown-product-remove cart_delete" data-id="{{ $item->rowId }}"><i class="icofont-bin"></i></span>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="cart-pricing my-4">
                                    <ul>
                                        <li>
                                            <span>Sub Total:</span>
                                            <span>${{ Cart::subtotal() }}</span>
                                        </li>
                                     {{--   <li>
                                            <span>Shipping:</span>
                                            <span>$30.00</span>
                                        </li>--}}
                                        <li>
                                            <span>Total:</span>
                                            @if (session()->has('coupon'))
                                            <span>${{ Cart::subtotal() - session('coupon')['value'] }} </span>
                                            @else
                                                 <span>${{ Cart::subtotal() }}</span>
                                            @endif
                                           
                                        </li>
                                    </ul>
                                </div>
                                <div class="cart-box d-flex">
                                    <a href="{{ route('cart') }}" class="btn btn-success btn-sm mr-2">Cart</a>
                                    <a href="{{ route('checkout1') }}" class="btn btn-primary btn-sm float-right">Checkout</a>
                                </div>
                            </div>
                        </div>
                        <!-- Account -->
                        <div class="account-area">
                            <div class="user-thumbnail">
                                @if (@auth()->user()->photo)
                                <img src="{{ auth()->user()->photo }}" alt="">
                                @else
                                <img src="{{ Helpers::userDefaultImage() }}" alt="">
                                @endif
                                
                            </div>
                            <ul class="user-meta-dropdown">
                                @auth
                                    <li class="user-title"><span>Hello,</span> {{ auth()->user()->full_name }}</li>
                                    <li><a href="{{ route('user.dashboard') }}">My Account</a></li>
                                    <li><a href="{{ route('user.order') }}">Orders List</a></li>
                                    <li><a href="bigshop-2.3.0/wishlist.html">Wishlist</a></li>
                                    <li><a href="{{ route('user.logout') }}"><i class="icofont-logout"></i> Logout</a></li>
                                @else
                                    <li class="user-title"><a href="{{ route('user.auth') }}">Login/Register</a>  </li>
                                  
                                @endauth
                              
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
