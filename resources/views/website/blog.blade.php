@extends('layouts.website')
@section('title', 'Blog')
@section('styles')
@endsection
@section('content')
    <!-- ##### Blog Area Start ##### -->
    <section class="south-blog-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">

                    <!-- Single Blog Area -->
                    <div class="single-blog-area mb-50">
                        <!-- Post Thumbnail -->
                        <div class="blog-post-thumbnail">
                            <img src="{{ asset('assets/website/img/blog-img/blog1.jpg') }}" alt="">
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <!-- Date -->
                            <div class="post-date">
                                <a href="#">March 09, 2018</a>
                            </div>
                            <!-- Headline -->
                            <a href="#" class="headline">How to get the best deal for your house</a>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p>By <a href="#">Admin</a> | in <a href="#">Uncategorized</a> | <a
                                        href="#">2 Comments</a></p>
                            </div>
                            <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus
                                blandit. Etiam nec odiomattis effic iturut magna. Pellentesque sit am et tellus blandit.
                                Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna. Curabitur
                                rhoncus auctor eleifend.</p>
                            <!-- Read More btn -->
                            <a href="#" class="btn south-btn">Read More</a>
                        </div>
                    </div>

                    <!-- Single Blog Area -->
                    <div class="single-blog-area mb-50">
                        <!-- Post Thumbnail -->
                        <div class="blog-post-thumbnail">
                            <img src="{{ asset('assets/website/img/blog-img/blog2.jpg') }}" alt="">
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <!-- Date -->
                            <div class="post-date">
                                <a href="#">March 09, 2018</a>
                            </div>
                            <!-- Headline -->
                            <a href="#" class="headline">How to get the best deal for your house</a>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p>By <a href="#">Admin</a> | in <a href="#">Uncategorized</a> | <a
                                        href="#">2 Comments</a></p>
                            </div>
                            <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus
                                blandit. Etiam nec odiomattis effic iturut magna. Pellentesque sit am et tellus blandit.
                                Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna. Curabitur
                                rhoncus auctor eleifend.</p>
                            <!-- Read More btn -->
                            <a href="#" class="btn south-btn">Read More</a>
                        </div>
                    </div>

                    <!-- Single Blog Area -->
                    <div class="single-blog-area mb-50">
                        <!-- Post Thumbnail -->
                        <div class="blog-post-thumbnail">
                            <img src="{{ asset('assets/website/img/blog-img/blog3.jpg') }}" alt="">
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <!-- Date -->
                            <div class="post-date">
                                <a href="#">March 09, 2018</a>
                            </div>
                            <!-- Headline -->
                            <a href="#" class="headline">How to get the best deal for your house</a>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p>By <a href="#">Admin</a> | in <a href="#">Uncategorized</a> | <a
                                        href="#">2 Comments</a></p>
                            </div>
                            <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus
                                blandit. Etiam nec odiomattis effic iturut magna. Pellentesque sit am et tellus blandit.
                                Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna. Curabitur
                                rhoncus auctor eleifend.</p>
                            <!-- Read More btn -->
                            <a href="#" class="btn south-btn">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="blog-sidebar-area">

                        <!-- Search Widget -->
                        <div class="search-widget-area mb-70">
                            <form action="#" method="get">
                                <input type="search" name="search" id="search" placeholder="Search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <!-- Catagories Widget -->
                        <div class="south-catagories-card mb-70">
                            <h5>Archive</h5>
                            <ul class="catagories-menu">
                                <li><a href="#">Radiology</a></li>
                                <li><a href="#">Cardiology</a></li>
                                <li><a href="#">Gastroenterology</a></li>
                                <li><a href="#">Neurology</a></li>
                                <li><a href="#">General surgery</a></li>
                            </ul>
                        </div>

                        <!-- Catagories Widget -->
                        <div class="south-catagories-card mb-70">
                            <h5>Categories</h5>
                            <ul class="catagories-menu">
                                <li><a href="#">Radiology</a></li>
                                <li><a href="#">Cardiology</a></li>
                                <li><a href="#">Gastroenterology</a></li>
                                <li><a href="#">Neurology</a></li>
                                <li><a href="#">General surgery</a></li>
                            </ul>
                        </div>

                        <!-- Catagories Widget -->
                        <div class="featured-properties-slides owl-carousel">

                            @foreach ($properties as $property)
                                <!-- Single Slide -->
                                <div class="single-featured-property">
                                    <!-- Property Thumbnail -->
                                    <div class="property-thumb">
                                        @if ($property->images->isEmpty())
                                            <img src="{{ asset('assets/website/img/bg-img/feature1.jpg') }}" alt="">
                                        @else
                                            <img src="{{ $property->images[0]->image_url }}" alt="">
                                        @endif
                                        <div class="tag">
                                            @if ($property->process_type == 0)
                                                <span>For Sale</span>
                                            @else
                                                <span>For Rent</span>
                                            @endif
                                        </div>
                                        <div class="list-price">
                                            <p>{{ $property->price }}</p>
                                        </div>
                                    </div>
                                    <!-- Property Content -->
                                    <div class="property-content">
                                        <h5>{{ $property->title }}</h5>
                                        <p class="location"><img src="{{ asset('assets/website/img/icons/location.png') }}"
                                                alt="">{{ $property->address }}, {{ $property->city }},
                                            {{ $property->country }}</p>
                                        </p>
                                        <p>{{ $property->description }}</p>
                                        <div class="property-meta-data d-flex align-items-end justify-content-between">
                                            <div class="new-tag">
                                                <img src="{{ asset('assets/website/img/icons/new.png') }}" alt="">
                                            </div>
                                            <div class="bathroom">
                                                <img src="{{ asset('assets/website/img/icons/bathtub.png') }}"
                                                    alt="">
                                                <span>{{ $property->bathrooms }}</span>
                                            </div>
                                            <div class="bed">
                                                <img src="{{ asset('assets/website/img/icons/bed.png') }}" alt="">
                                                <span>{{ $property->bedrooms }}</span>
                                            </div>
                                            <div class="space">
                                                <img src="{{ asset('assets/website/img/icons/space.png') }}"
                                                    alt="">
                                                <span>{{ $property->size }} sq ft</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Pagination -->
                    <div class="south-pagination mt-100 d-flex">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link active" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- #
@endsection
@section('scripts')
@endsection
