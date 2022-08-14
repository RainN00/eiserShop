<!--================Header Menu Area =================-->
<header class="header_area">
    <div class="top_menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="float-left">
                        <p>Phone: +84 389 935 504</p>
                        <p>email: thanhluannguyen.dev@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="float-right">
                        <ul class="right_side">
                            <li>
                                <a href="#">
                                    gift card
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    track order
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('client.contact.index') }}">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_menu">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light w-100">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ route('client.home') }}">
                    <img src="{{ asset('customer/img/logo.png') }}" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                    <div class="row w-100 mr-0">
                        <div class="col-lg-7 pr-0">
                            <ul class="nav navbar-nav center_nav pull-right">
                                <li class="nav-item {{ Request::is('/') ? 'active' : ''}}">
                                    <a class="nav-link" href="{{ route('client.home') }}">Home</a>
                                </li>
                                <li class="nav-item {{ Request::is('categories/*') || Request::is('categories') ? 'active' : ''}}">
                                    <a class="nav-link" href="{{ route('client.categories.index') }}">Shop category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-5 pr-0">
                            <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                <li class="nav-item">
                                    <a href="{{ route('client.carts.index') }}" class="icons">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                </li>&emsp;
                                @if (Auth::check())
                                    <li class="nav-item submenu dropdown">
                                        <a href="#" class="icons nav-link dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true" aria-expanded="false">
                                            <img class="nav-item_img-user" src="{{ asset(Auth::user()->avatar) }}" alt="">
                                            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('client.users.profile') }}">Profile</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('client.users.history.cart') }}">History cart</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('client.users.logout') }}">Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item {{ Request::is('/user/login') ? 'active' : ''}}">
                                        <a class="nav-link" href="{{ route('client.users.login') }}">Login</a>
                                    </li>
                                    <li class="nav-item {{ Request::is('/user/register') ? 'active' : ''}}">
                                        <a class="nav-link" href="{{ route('client.users.register') }}">&emsp;/&emsp;Register</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
<!--================Header Menu Area =================-->
