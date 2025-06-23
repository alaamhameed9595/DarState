@extends('layouts.admin')
    @section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span>Overview <i
                                class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            @haspermission('view statistics')
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">

                                <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Posts <i
                                        class="mdi mdi-chart-line mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5"> $posts</h2>
                                <h6 class="card-text">Forever</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Categories<i
                                        class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5">$categories </h2>
                                <h6 class="card-text">Forever</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Admins<i class="mdi mdi-diamond mdi-24px float-end"></i>
                                </h4>
                                <h2 class="mb-5"> $users </h2>
                                <h6 class="card-text">Forever</h6>
                            </div>
                        </div>
                    </div>
                </div>
            @endhaspermission

        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
         @endsection
