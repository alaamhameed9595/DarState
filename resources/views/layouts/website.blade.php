<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>South - Real Estate Agency Template | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('assets/website/img/core-img/favicon.ico') }}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/website/style.css') }}">
    @yield('styles')

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="south-load"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">

        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="h-100 d-md-flex justify-content-between align-items-center">
                <div class="email-address">
                    <a href="mailto:alaamhameed9595@gmail.com">contact@darstate.com</a>
                </div>
                <div class="phone-number d-flex">
                    <div class="icon">
                        <img src="{{ asset('assets/website/img/icons/phone-call.png') }}" alt="">
                    </div>
                    <div class="number">
                        <a href="tel:+971 50 6074002">+971506074002</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header Area -->
        <div class="main-header-area" id="stickyHeader">
            <div class="classy-nav-container breakpoint-off">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="southNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="route('properties.index')"><img
                            src="{{ asset('assets/website/img/core-img/logo.png') }}" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="{{ route('properties.index') }}">Home</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('properties.index') }}">Home</a></li>
                                        <li><a href="{{ route('website.about') }}">About Us</a></li>
                                        <li><a href="#">Listings</a>
                                            <ul class="dropdown">
                                                <li><a href="#">Listings</a></li>
                                                <li><a href="#">Single Listings</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Blog</a>
                                            <ul class="dropdown">
                                                <li><a href="{{ route('website.blog') }}">Blog</a></li>
                                                <li><a href="{{ route('website.blog') }}">Single Blog</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('website.contact') }}">Contact</a></li>

                                    </ul>
                                </li>
                                <li><a href="{{ route('website.about') }}">About Us</a></li>
                                <li><a href="{{ route('properties.index') }}">Properties</a></li>
                                <li><a href="{{ route('website.blog') }}">Blog</a></li>
                                <li><a href="#">Mega Menu</a>
                                    <div class="megamenu">
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Headline 1</li>
                                            <li><a href="#">Mega Menu Item 1</a></li>
                                            <li><a href="#">Mega Menu Item 2</a></li>
                                            <li><a href="#">Mega Menu Item 3</a></li>
                                            <li><a href="#">Mega Menu Item 4</a></li>
                                            <li><a href="#">Mega Menu Item 5</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Headline 2</li>
                                            <li><a href="#">Mega Menu Item 1</a></li>
                                            <li><a href="#">Mega Menu Item 2</a></li>
                                            <li><a href="#">Mega Menu Item 3</a></li>
                                            <li><a href="#">Mega Menu Item 4</a></li>
                                            <li><a href="#">Mega Menu Item 5</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Headline 3</li>
                                            <li><a href="#">Mega Menu Item 1</a></li>
                                            <li><a href="#">Mega Menu Item 2</a></li>
                                            <li><a href="#">Mega Menu Item 3</a></li>
                                            <li><a href="#">Mega Menu Item 4</a></li>
                                            <li><a href="#">Mega Menu Item 5</a></li>
                                        </ul>
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">Headline 4</li>
                                            <li><a href="#">Mega Menu Item 1</a></li>
                                            <li><a href="#">Mega Menu Item 2</a></li>
                                            <li><a href="#">Mega Menu Item 3</a></li>
                                            <li><a href="#">Mega Menu Item 4</a></li>
                                            <li><a href="#">Mega Menu Item 5</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="{{ route('website.contact') }}">Contact</a></li>
                            </ul>

                            <!-- Search Form -->
                            <div class="south-search-form">
                                <form action="{{ route('search') }}" method="post">
                                    @csrf
                                    <input type="search" name="q" id="search"
                                        placeholder="Search Anything ...">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>

                            <!-- Search Button -->
                            <a href="#" class="searchbtn"><i class="fa" aria-hidden="true"></i></a>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header><!-- header close -->
    <!-- Header End -->
    @yield('content')
    <!-- footer Start -->
    <footer class="footer-area section-padding-100-0 bg-img gradient-background-overlay"
        style="background-image: url('{{ asset('assets/website/img/bg-img/cta.jpg') }}');">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>About Us</h6>
                            </div>

                            <img src="{{ asset('assets/website/img/bg-img/footer.jpg') }}" alt="">
                            <div class="footer-logo my-4">
                                <img src="{{ asset('assets/website/img/core-img/logo.png') }}" alt="">
                            </div>
                            <p>Integer nec bibendum lacus. Suspen disse dictum enim sit amet libero males uada feugiat.
                                Praesent malesuada.</p>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Hours</h6>
                            </div>
                            <!-- Office Hours -->
                            <div class="weekly-office-hours">
                                <ul>
                                    <li class="d-flex align-items-center justify-content-between"><span>Monday -
                                            Friday</span> <span>09 AM - 19 PM</span></li>
                                    <li class="d-flex align-items-center justify-content-between"><span>Saturday</span>
                                        <span>09 AM - 14 PM</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between"><span>Sunday</span>
                                        <span>Closed</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- Address -->
                            <div class="address">
                                <h6><img src="{{ asset('assets/website/img/icons/phone-call.png') }}" alt="">
                                    +971 506074002</h6>
                                <h6><img src="{{ asset('assets/website/img/icons/envelope.png') }}" alt="">
                                    contact@darstate.com</h6>
                                <h6><img src="{{ asset('assets/website/img/icons/location.png') }}" alt="">
                                    Mayah Str. no 8, b5, 56832,
                                    AlAin , UAE</h6>
                            </div>
                            <!-- Social links -->
                            <div class="social-links d-flex align-items-center gap-3" style="gap: 24px;">
                                <a href="https://www.facebook.com/profile.php?id=61577934653375" target="_blank"
                                    class="d-flex align-items-center">
                                    <img src="{{ asset('assets/website/img/icons/facebook.png') }}" alt="Facebook"
                                        style="width:28px;height:28px;margin-right:8px;">
                                </a>
                                <a href="https://t.me/DarStateCity" target="_blank"
                                    class="d-flex align-items-center">
                                    <img src="{{ asset('assets/website/img/icons/telegram.png') }}" alt="Telegram"
                                        style="width:28px;height:28px;margin-right:8px;">
                                </a>
                                <a href="{{ route('properties.index') }}" target="_blank"
                                    class="d-flex align-items-center">
                                    <img src="{{ asset('assets/website/img/icons/website.png') }}" alt="Website"
                                        style="width:28px;height:28px;margin-right:8px;">
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Useful Links</h6>
                            </div>
                            <!-- Nav -->
                            <ul class="useful-links-nav d-flex align-items-center">
                                <li><a href="{{ route('properties.index') }}">Home</a></li>
                                <li><a href="{{ route('website.about') }}">About us</a></li>
                                <li><a href="{{ route('website.services') }}">Services</a></li>
                                <li><a href="{{ route('properties.index') }}">Properties</a></li>
                                <li><a href="{{ route('website.blog') }}">Blog</a></li>
                                <li><a href="{{ route('website.contact') }}">Contact</a></li>
                                <li><a href="{{ route('website.faq') }}">FAQ</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Single Footer Widget -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="footer-widget-area mb-100">
                            <!-- Widget Title -->
                            <div class="widget-title">
                                <h6>Featured Properties</h6>
                            </div>
                            <!-- Featured Properties Slides -->
                            <div class="featured-properties-slides owl-carousel">
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img
                                            src="{{ asset('assets/website/img/bg-img/fea-product.jpg') }}"
                                            alt=""></a>
                                </div>
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img
                                            src="{{ asset('assets/website/img/bg-img/fea-product.jpg') }}"
                                            alt=""></a>
                                </div>
                                <!-- Single Slide -->
                                <div class="single-featured-properties-slide">
                                    <a href="#"><img
                                            src="{{ asset('assets/website/img/bg-img/fea-product.jpg') }}"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('assets/website/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('assets/website/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('assets/website/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('assets/website/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/website/js/classy-nav.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/jquery-ui.min.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('assets/website/js/active.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>
    <script>
        function syncSessionStorageToLaravel(key) {
            const value = sessionStorage.getItem(key);
            if (value) {
                fetch('/api/session-sync', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        key,
                        value
                    })
                });
            }
        }

        // Force ask for location if not present in sessionStorage
        if (!sessionStorage.getItem('user_location')) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const coords = {
                        latitude: position.coords.latitude,
                        longitude: position.coords.longitude
                    };
                    sessionStorage.setItem('user_location', JSON.stringify(coords));
                    syncSessionStorageToLaravel('user_location');
                }, function(error) {
                    alert('Location access is required for the best experience.');
                });
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        } else {
            syncSessionStorageToLaravel('user_location');
        }

        var botmanWidget = {
            introMessage: "\uD83D\uDC4B Hi there! I'm your Property Search Helper. Ask me about listings by location, price, or type!",
            bubbleBackground: '#73c3ec',
            mainColor: '#947054',
            sendButtonText: 'Send',
            desktopHeight: 450,
            desktopWidth: 370,
            title: 'DarState Assistant',
            mobileHeight: 400,
            mobileWidth: 300,
        };
    </script>
    @yield('scripts')

</body>

</html>
