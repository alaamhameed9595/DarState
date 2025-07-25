<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->

    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.png') }}" />
    <!-- Leaflet CSS -->

    <!-- Custom Notification Styles -->
    <style>
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 20px;
            height: 20px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            animation: pulse 2s infinite;
            border: 2px solid #fff;
        }

        .notification-badge:empty {
            display: none !important;
        }

        .pulse-animation {
            animation: pulse 0.5s ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        /* Enhanced unread notification styling */
        .table-light {
            background-color: #f8f9fa !important;
            border-left: 4px solid #007bff;
        }

        .table-light:hover {
            background-color: #e9ecef !important;
        }

        /* Notification dropdown enhancements */
        .notification-item {
            transition: all 0.3s ease;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        /* Badge enhancements */
        .badge {
            font-size: 0.75em;
            padding: 0.35em 0.65em;
            border-radius: 0.375rem;
        }

        .badge.bg-danger {
            background-color: #dc3545 !important;
            color: white;
        }

        .badge.bg-success {
            background-color: #198754 !important;
            color: white;
        }
    </style>

    @yield('styles')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo" href="{{ route('auth.dashboard') }}"><img
                        src="{{ asset('assets/admin/images/logo.svg') }}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="{{ asset('assets/admin/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                {{-- <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects">
                        </div>
                    </form>
                </div> --}}
                <ul class="navbar-nav navbar-nav-right">
                    {{-- <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ asset('assets/admin/images/faces/face1.jpg') }}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ auth()->user()->name }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                        </div>
                    </li> --}}
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets/admin/images/faces/face4.jpg') }}" alt="image"
                                        class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a
                                        message</h6>
                                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets/admin/images/faces/face2.jpg') }}" alt="image"
                                        class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a
                                        message</h6>
                                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{ asset('assets/admin/images/faces/face3.jpg') }}" alt="image"
                                        class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture
                                        updated</h6>
                                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger notification-badge" id="notificationCount" style="display: none;"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notifications</h6>
                            <div class="dropdown-divider"></div>
                            <div id="notificationsList">
                                <!-- Dynamic notifications will be loaded here -->
                            </div>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">
                                <a href="{{ route('auth.notifications.index') }}" class="text-decoration-none">See all notifications</a>
                            </h6>
                        </div>
                    </li>



                    <li class="nav-item nav-logout d-none d-lg-block">
                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                            @csrf
                            <a class="nav-link logout" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();" id="logout-button">
                                <i class="mdi mdi-power"></i>
                            </a>
                        </form>

                    </li>
                    {{-- <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li> --}}
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{ asset('assets/admin/images/faces/face1.jpg') }}" alt="profile" />
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                                <span
                                    class="text-secondary text-small">{{ auth()->user()->getRoleAttribute() }}</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.dashboard') }}">
                            <span class="menu-title">Dashboard</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>

                    <!--  -- Property section -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <span class="menu-title">Properties</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-folder menu-icon"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                @haspermission('create properties')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('auth.properties.create') }}">Create
                                            Property
                                            <i class="mdi mdi-plus-box menu-icon"></i>
                                        </a>
                                    </li>
                                @endhaspermission
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('auth.properties.manage') }}">All
                                        Properties
                                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>

                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <!--  --  end properties section -->

                    @haspermission('view features')
                        <!--  -- feature section -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="true"
                                aria-controls="ui-basic2">
                                <span class="menu-title">Features</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-tag-multiple menu-icon"></i>
                            </a>
                            <div class="collapse" id="ui-basic2">
                                <ul class="nav flex-column sub-menu">
                                    @haspermission('create features')
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('auth.features.create') }}"
                                                data-bs-toggle="modal" data-bs-target="#addFeatureModal">Create Feature
                                                <i class="mdi mdi-plus-box menu-icon"></i>
                                            </a>
                                        </li>
                                    @endhaspermission
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('auth.features.index') }}">All Features
                                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>

                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <!--  --  end feature section -->
                    @endhaspermission

                    <!--  -- Notifications section -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.notifications.index') }}">
                            <span class="menu-title">Notifications</span>
                            <i class="mdi mdi-bell menu-icon"></i>
                        </a>
                    </li>
                    <!--  --  end notifications section -->

                    <!--  -- posts section -->
                    <li class="nav-item">
                        {{-- <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="true"
                            aria-controls="ui-basic1">
                            <span class="menu-title">Posts</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-post-outline menu-icon"></i>
                        </a> --}}
                        <div class="collapse" id="ui-basic1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    {{-- <a class="nav-link" href="{{ route('auth.post.create') }}">Create Post
                                        <i class="mdi mdi-plus-box menu-icon"></i>
                                    </a> --}}
                                </li>
                                <li class="nav-item">
                                    {{-- <a class="nav-link" href="{{ route('auth.posts') }}">All Posts
                                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>

                                    </a> --}}
                                </li>

                            </ul>
                        </div>
                    </li>

                    <!--  --  end posts section -->

                    @haspermission('manage users')
                        <li class="nav-item">
                            {{-- <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                                aria-controls="charts">
                                <span class="menu-title">Charts</span>
                                <i class="mdi mdi-chart-bar menu-icon"></i>
                            </a> --}}
                            <div class="collapse" id="charts">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                                aria-controls="auth">
                                <span class="menu-title">User Pages</span>
                                <i class="menu-arrow"></i>
                                <i class="mdi mdi-lock menu-icon"></i>
                            </a>
                            <div class="collapse" id="auth">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pages/samples/login.html"> Login </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pages/samples/register.html"> Register </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endhaspermission

                </ul>
            </nav>

            @yield('content')

            <!-- Add Feature Modal -->
            <div class="modal fade" id="addFeatureModal" tabindex="-1" aria-labelledby="addFeatureModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFeatureModalLabel">Add New Feature</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('auth.features.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="feature_name">Feature Name</label>
                                    <input type="text" class="form-control" id="feature_name" name="name"
                                        required placeholder="Enter feature name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add Feature</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>








            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/admin/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/admin/js/misc.js') }}"></script>
    <script src="{{ asset('assets/admin/js/settings.js') }}"></script>
    <script src="{{ asset('assets/admin/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.cookie.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.9.4/dist/leaflet.markercluster.js"></script>
    <script>
        $(document).ready(function() {
            $('#logout-button').click(function() {
                $('#logout-form').submit();
            });

            // Load notifications on page load
            loadNotifications();
            updateNotificationCount();

            // Load notifications when dropdown is opened
            $('#notificationDropdown').on('show.bs.dropdown', function() {
                loadNotifications();
            });

            // Function to load recent notifications
            function loadNotifications() {
                $.get('{{ route("auth.notifications.recent") }}')
                .done(function(response) {
                    var notifications = response.notifications;
                    var notificationsList = $('#notificationsList');
                    notificationsList.empty();

                    if (notifications.length > 0) {
                        notifications.forEach(function(notification) {
                            var icon = getNotificationIcon(notification.data.type);
                            var bgClass = getNotificationBgClass(notification.data.type);
                            var timeAgo = moment(notification.created_at).fromNow();

                            var notificationHtml = `
                                <a class="dropdown-item preview-item notification-item" data-id="${notification.id}">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon ${bgClass}">
                                            <i class="${icon}"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="preview-subject font-weight-normal mb-1">${notification.data.title || 'Notification'}</h6>
                                        <p class="text-gray ellipsis mb-0">${notification.data.message || 'No message available'}</p>
                                        <small class="text-gray">${timeAgo}</small>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                            `;
                            notificationsList.append(notificationHtml);
                        });
                    } else {
                        notificationsList.html('<div class="p-3 text-center text-muted">No new notifications</div>');
                    }
                })
                .fail(function() {
                    $('#notificationsList').html('<div class="p-3 text-center text-danger">Error loading notifications</div>');
                });
            }

                        // Function to update notification count
            function updateNotificationCount() {
                $.get('{{ route("auth.notifications.unread-count") }}')
                .done(function(response) {
                    var count = response.count;
                    var countElement = $('#notificationCount');

                    if (count > 0) {
                        countElement.text(count);
                        countElement.show();
                        // Add animation class for new notifications
                        countElement.addClass('pulse-animation');
                        setTimeout(function() {
                            countElement.removeClass('pulse-animation');
                        }, 1000);
                    } else {
                        countElement.hide();
                    }
                });
            }

            // Function to get notification icon
            function getNotificationIcon(type) {
                switch(type) {
                    case 'property_inquiry':
                        return 'mdi mdi-home';
                    case 'contact_form':
                        return 'mdi mdi-email';
                    default:
                        return 'mdi mdi-bell';
                }
            }

            // Function to get notification background class
            function getNotificationBgClass(type) {
                switch(type) {
                    case 'property_inquiry':
                        return 'bg-info';
                    case 'contact_form':
                        return 'bg-warning';
                    default:
                        return 'bg-secondary';
                }
            }

            // Auto-refresh notification count every 30 seconds
            setInterval(updateNotificationCount, 30000);
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: '{{ session('warning') }}',
                timer: 2000,
                showConfirmButton: true
            });
        </script>
    @endif
    @yield('scripts')
    <!-- End custom js for this page -->
</body>

</html>
