<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="darState is real state service in daraa in syria for rent and sale">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="@yield('meta_keywords', 'real estate, properties, buy, sell, rent,daraa,syria,looking for,apartment,land,flat,villa,townhouse')">
    <meta property="og:title" content="@yield('og_title', 'Default OG Title')" />
    <meta property="og:description" content="@yield('og_description', 'Default OG Description')" />
    <meta property="og:image" content="@yield('og_image', asset('default-og-image.jpg'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    @yield('structured_data')
    <!-- Title  -->
    <title>South - Real Estate Agency Template | Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('assets/website/img/core-img/favicon.ico') }}">

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/website/style.css') }}">
    @yield('styles')
    @include('layouts.ga')

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

    <!-- Custom BotMan Professional Styling -->
    <style>
        /* Professional BotMan Widget Styling */
        .botman-widget {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }

        .botman-widget .widget-container {
            border-radius: 16px !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .botman-widget .widget-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
            border-radius: 16px 16px 0 0 !important;
            padding: 16px 20px !important;
        }

        .botman-widget .widget-header h3 {
            font-weight: 600 !important;
            letter-spacing: 0.5px !important;
        }

        .botman-widget .widget-messages-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
            border-radius: 0 0 16px 16px !important;
        }

        .botman-widget .message {
            border-radius: 18px !important;
            margin: 8px 12px !important;
            padding: 12px 18px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
        }

        .botman-widget .message.bot {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%) !important;
            border: 1px solid #e9ecef !important;
            color: #2c3e50 !important;
            margin-right: 20px !important;
        }

        .botman-widget .message.user {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%) !important;
            color: #ffffff !important;
            margin-left: 20px !important;
            text-align: right !important;
        }

        .botman-widget .widget-input-container {
            background: #ffffff !important;
            border-top: 1px solid #e9ecef !important;
            padding: 16px !important;
            border-radius: 0 0 16px 16px !important;
        }

        .botman-widget .widget-input {
            border: 2px solid #e9ecef !important;
            border-radius: 25px !important;
            padding: 12px 20px !important;
            font-size: 14px !important;
            transition: all 0.3s ease !important;
        }

        .botman-widget .widget-input:focus {
            border-color: #3498db !important;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1) !important;
            outline: none !important;
        }

        .botman-widget .widget-send-button {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%) !important;
            border: none !important;
            border-radius: 50% !important;
            width: 40px !important;
            height: 40px !important;
            transition: all 0.3s ease !important;
        }

        .botman-widget .widget-send-button:hover {
            transform: scale(1.1) !important;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3) !important;
        }

        .botman-widget .widget-bubble {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
            border-radius: 50px !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2) !important;
            transition: all 0.3s ease !important;
        }

        .botman-widget .widget-bubble:hover {
            transform: scale(1.05) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25) !important;
        }

        /* Typing indicator */
        .botman-widget .typing-indicator {
            background: #3498db !important;
        }

        /* Scrollbar styling */
        .botman-widget .widget-messages-container::-webkit-scrollbar {
            width: 6px !important;
        }

        .botman-widget .widget-messages-container::-webkit-scrollbar-track {
            background: #f1f1f1 !important;
            border-radius: 3px !important;
        }

        .botman-widget .widget-messages-container::-webkit-scrollbar-thumb {
            background: #bdc3c7 !important;
            border-radius: 3px !important;
        }

        .botman-widget .widget-messages-container::-webkit-scrollbar-thumb:hover {
            background: #95a5a6 !important;
        }

        /* Facebook Messenger-style buttons */
        .botman-widget .widget-actions {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
            margin-top: 12px !important;
        }

        .botman-widget .widget-action {
            background: #0084ff !important;
            color: #ffffff !important;
            border: none !important;
            border-radius: 18px !important;
            padding: 8px 16px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            box-shadow: 0 2px 4px rgba(0, 132, 255, 0.3) !important;
            margin: 2px !important;
            max-width: 200px !important;
            text-align: center !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        }

        .botman-widget .widget-action:hover {
            background: #0073e6 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 8px rgba(0, 132, 255, 0.4) !important;
        }

        .botman-widget .widget-action:active {
            transform: translateY(0) !important;
            box-shadow: 0 2px 4px rgba(0, 132, 255, 0.3) !important;
        }

        /* Messenger-style message bubbles */
        .botman-widget .message.bot {
            background: #f0f0f0 !important;
            color: #000000 !important;
            border-radius: 18px 18px 18px 4px !important;
            margin-right: 40px !important;
            margin-left: 8px !important;
            border: none !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        }

        .botman-widget .message.user {
            background: #0084ff !important;
            color: #ffffff !important;
            border-radius: 18px 18px 4px 18px !important;
            margin-left: 40px !important;
            margin-right: 8px !important;
            text-align: right !important;
            border: none !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) !important;
        }

        /* Professional animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes buttonPop {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .botman-widget .widget-action {
            animation: buttonPop 0.3s ease-out !important;
        }

        /* Property slider styling */
        .botman-widget .message.bot {
            max-height: 400px !important;
            overflow-y: auto !important;
        }

        .botman-widget .widget-actions {
            justify-content: center !important;
        }

        /* Property button styling */
        .botman-widget .widget-action[data-value^="property_"] {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border: 2px solid #ffffff !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4) !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        .botman-widget .widget-action[data-value^="property_"]:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6) !important;
        }

        /* View all properties button */
        .botman-widget .widget-action[data-value="view_all"] {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4) !important;
        }

        .botman-widget .widget-action[data-value="view_all"]:hover {
            background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%) !important;
            box-shadow: 0 6px 20px rgba(17, 153, 142, 0.6) !important;
        }

        /* Contact agent button */
        .botman-widget .widget-action[data-value="contact"] {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%) !important;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4) !important;
        }

        .botman-widget .widget-action[data-value="contact"]:hover {
            background: linear-gradient(135deg, #ee5a24 0%, #ff6b6b 100%) !important;
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.6) !important;
        }

        .botman-widget .message {
            animation: fadeInUp 0.3s ease-out !important;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .botman-widget .widget-container {
                border-radius: 12px !important;
            }

            .botman-widget .message {
                margin: 6px 8px !important;
                padding: 10px 14px !important;
                font-size: 13px !important;
            }
        }
    </style>
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
            introMessage: "🏢 Welcome to DarState! I'm your professional real estate assistant. How can I help you today?",
            bubbleBackground: '#2c3e50',
            mainColor: '#34495e',
            sendButtonText: 'Send',
            desktopHeight: 500,
            desktopWidth: 400,
            title: 'DarState Professional Assistant',
            mobileHeight: 450,
            mobileWidth: 320,
            background: '#f8f9fa',
            headerTextColor: '#ffffff',
            headerBackgroundColor: '#2c3e50',
            botMessageBackground: '#ffffff',
            botMessageTextColor: '#2c3e50',
            userMessageBackground: '#3498db',
            userMessageTextColor: '#ffffff',
            placeholderText: 'Type your message here...',
            aboutText: 'DarState Professional Real Estate Assistant',
            aboutLink: 'https://darstate.com',
            chatBackground: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            bubbleBackground: '#2c3e50',
            bubbleTextColor: '#ffffff',
            bubbleBorderRadius: '50px',
            bubbleShadow: '0 4px 12px rgba(0,0,0,0.15)',
            chatWindowBackground: 'rgba(255, 255, 255, 0.95)',
            chatWindowBorderRadius: '12px',
            chatWindowShadow: '0 8px 32px rgba(0,0,0,0.1)',
            inputBackground: '#ffffff',
            inputBorderColor: '#e9ecef',
            inputTextColor: '#2c3e50',
            sendButtonBackground: '#3498db',
            sendButtonTextColor: '#ffffff',
            sendButtonBorderRadius: '8px',
            sendButtonHoverBackground: '#2980b9',
            messageBorderRadius: '12px',
            messageMargin: '8px',
            messagePadding: '12px 16px',
            botMessageBorder: '1px solid #e9ecef',
            userMessageBorder: 'none',
            typingIndicatorColor: '#3498db',
            scrollbarColor: '#bdc3c7',
            scrollbarTrackColor: '#ecf0f1'
        };
    </script>
    @yield('scripts')

</body>

</html>
