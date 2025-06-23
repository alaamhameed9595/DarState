<!DOCTYPE html>

<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Airspace | Your CMS </title>
    @yield('head')

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Creative Agency Bootstrap Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="theme-name" content="airspace">
    <meta name="generator" content="Themefisher Airspace Template v1.0">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />


    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('assets/website/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- Ionic Icon Css -->
    <link rel="stylesheet" href="{{ asset('assets/website/plugins/Ionicons/css/ionicons.min.css') }}">
    <!-- animate.css -->
    <link rel="stylesheet" href="{{ asset('assets/website/plugins/animate-css/animate.css') }}">
    <!-- Magnify Popup -->
    <link rel="stylesheet" href="{{ asset('assets/website/plugins/magnific-popup/magnific-popup.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/website/plugins/slick/slick.css') }}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">

</head>

<body id="body">

    <!-- Header Start -->
    <header class="navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg p-0">
                        <a class="navbar-brand" href="{{ route('website.home') }}">
                            <img src="{{ asset('assets/website/images/logo.png') }}" alt="Logo">
                        </a>

                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                            data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="ion-android-menu"></span>
                        </button>

                        <div class="collapse navbar-collapse ml-auto" id="navbarsExample09">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('website.home') }}">Home</a>
                                </li>
                                <li class="nav-item dropdown @@portfolio">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Portfolio
                                        <span class="ion-ios-arrow-down"></span></a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                        <li><a class="dropdown-item @@portfolioFilter"
                                                href="{{ route('website.portfolio') }}">Portfolio Filter</a></li>
                                        <li><a class="dropdown-item @@portfolioSingle"
                                                href="{{ route('website.portfolio_single') }}">Portfolio Single</a>
                                        </li>

                                        <li class="dropdown dropdown-submenu dropright">
                                            <a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0301"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Sub Menu</a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdown0301">
                                                <li><a class="dropdown-item" href="index.html">Submenu 01</a></li>
                                                <li><a class="dropdown-item" href="index.html">Submenu 02</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item @@service"><a class="nav-link"
                                        href="{{ route('website.service') }}">Service</a></li>
                                <li class="nav-item dropdown @@blog">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown05"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog <span
                                            class="ion-ios-arrow-down"></span></a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown05">
                                        <li><a class="dropdown-item @@blogGrid"
                                                href="blog-grid.html">Blog Grid</a></li>
                                        <li><a class="dropdown-item @@blogSingle" href="/blog">Blog
                                                Single</a></li>

                                        <li class="dropdown dropdown-submenu dropleft">
                                            <a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0501"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Sub Menu</a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdown0501">
                                                <li><a class="dropdown-item" href="index.html">Submenu 01</a></li>
                                                <li><a class="dropdown-item" href="index.html">Submenu 02</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown @@pages">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown05"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages <span
                                            class="ion-ios-arrow-down"></span></a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdown05">
                                        <li><a class="dropdown-item @@about"
                                                href="{{ route('website.about') }}">About Us</a></li>
                                        <li><a class="dropdown-item @@comingSoon"
                                                href="{{ route('website.coming_soon') }}">Coming Soon</a></li>
                                        <li><a class="dropdown-item @@404"
                                                href="{{ route('website.404') }}">404
                                                Page</a></li>
                                        <li><a class="dropdown-item @@faq"
                                                href="{{ route('website.faq') }}">FAQ</a></li>
                                        <li><a class="dropdown-item @@pricing"
                                                href="{{ route('website.pricing') }}">Pricing Table</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item @@contact"><a class="nav-link"
                                        href="{{ route('website.contact') }}">Contact</a></li>
                                {{--   <li>
                                    <div class="position-fixed" style="top: 1rem; right: 1rem; z-index: 9999;">
                                        <button id="darkModeToggle" class="btn btn-sm btn-secondary">
                                            <span id="darkModeIcon" class="mdi mdi-weather-night"></span> Dark Mode
                                        </button>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header><!-- header close -->
    <!-- Header End -->
    @yield('content')
    <!-- footer Start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footer-manu">
                        <ul>
                            <li><a href="{{ route('website.about') }}">About Us</a></li>
                            <li><a href="{{ route('website.contact') }}">Contact us</a></li>
                            <li><a href="{{ route('website.service') }}">How it works</a></li>
                            <li><a href="{{ route('website.faq') }}">FAQ</a></li>
                            <li><a href="{{ route('website.pricing') }}">Pricing</a></li>
                        </ul>
                    </div>
                    <p class="copyright mb-0">Copyright
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; Designed & Developed by Alaa Almhameed
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!--Scroll to top-->
    <div id="scroll-to-top" class="scroll-to-top">
        <span class="icon ion-ios-arrow-up"></span>
    </div>

    <!--
    Essential Scripts
    =====================================-->


    <!-- Main jQuery -->
    <script src="{{ asset('assets/website/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.1 -->
    <script src="{{ asset('assets/website/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <!-- slick Carousel -->
    <script src="{{ asset('assets/website/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/website/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <!-- filter -->
    <script src="{{ asset('assets/website/plugins/shuffle/shuffle.min.js') }}"></script>
    <script src="{{ asset('assets/website/plugins/SyoTimer/jquery.syotimer.min.js') }}"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places">
    </script>
    <script src="{{ asset('assets/website/plugins/google-map/map.js') }}"></script>

    <script src="{{ asset('assets/website/js/script.js') }}"></script>
    <script>
        // On page load, check localStorage
        if (localStorage.getItem('dark-mode') === 'enabled') {
            document.body.classList.add('dark-mode');
        }

        document.getElementById('darkModeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            // Save preference
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('dark-mode', 'enabled');
            } else {
                localStorage.setItem('dark-mode', 'disabled');
            }
        });
    </script>
</body>

</html>
