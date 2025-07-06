@extends('layouts.website')
@section('title', 'Home')
@section('content')
    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img"
                style="background-image:
                url({{ asset('assets/website/img/bg-img/hero1.jpg') }}); ">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms">Find your home</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img"
                style="background-image:url({{ asset('assets/website/img/bg-img/hero2.jpg') }});">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms">Find your dream house</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Hero Slide -->
            <div class="single-hero-slide bg-img"
                style="background-image:url({{ asset('assets/website/img/bg-img/hero3.jpg') }});">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12">
                            <div class="hero-slides-content">
                                <h2 data-animation="fadeInUp" data-delay="100ms">Find your perfect house</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Advance Search Area Start ##### -->
    <div class="south-search-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="advanced-search-form bg-white p-4 p-md-5 rounded shadow-sm mb-4 position-relative">
                        <!-- Search Title -->
                        <div class="search-title mb-3">
                            <h5 class="fw-bold mb-0">Search for your home</h5>
                        </div>
                        <!-- Search Form -->
                        <form action="{{ route('search') }}" method="post" id="advanceSearch">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <input type="input" class="form-control form-control-lg" name="q"
                                        placeholder="Search properties..." value="{{ request('q') }}">
                                </div>
                                <div class="col-6 col-md-3">
                                    <select class="form-select" name="city">
                                        <option value="">City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city }}">
                                                {{ $city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-3">
                                    <select class="form-select" name="type">
                                        <option value="">Category</option>
                                        @foreach ($types as $cat)
                                            <option value="{{ $cat }}">
                                                {{ $cat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-2">
                                    <input type="number" class="form-control" name="bedrooms" placeholder="Bedrooms"
                                        min="0" value="{{ request('bedrooms') }}">
                                </div>
                                <div class="col-6 col-md-2">
                                    <input type="number" class="form-control" name="bathrooms" placeholder="Bathrooms"
                                        min="0" value="{{ request('bathrooms') }}">
                                </div>
                                <div class="col-12 col-md-2">
                                    <select class="form-select" name="process_type">
                                        <option value="">Type</option>
                                        <option value="0" {{ request('process_type') == '0' ? 'selected' : '' }}>
                                            For Sale</option>
                                        <option value="1" {{ request('process_type') == '1' ? 'selected' : '' }}>
                                            For Rent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Area (sq. ft)</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="area_min"
                                                placeholder="Min Area" min="0" value="{{ request('area_min') }}">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="area_max"
                                                placeholder="Max Area" min="0" value="{{ request('area_max') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label fw-semibold">Price (Aed)</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="price_min"
                                                placeholder="Min Price" min="0" value="{{ request('price_min') }}">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="price_max"
                                                placeholder="Max Price" min="0"
                                                value="{{ request('price_max') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="row g-3 align-items-center">
                                <div class="col-12">
                                    <label class="fw-bold mb-2">Features</label>
                                    <div class="row g-2">
                                        @foreach ($features as $feature)
                                            <div class="col-6 col-md-4 col-lg-3">
                                                <div class="form-check custom-feature-check">
                                                    <input class="form-check-input" type="checkbox" name="features[]"
                                                        value="{{ $feature->id }}" id="feature_{{ $feature->id }}">
                                                    <label class="form-check-label" for="feature_{{ $feature->id }}">
                                                        {{ $feature->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  align-items-center mt-4">

                                <button type="submit" class="btn south-btn btn-lg px-5">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .advanced-search-form {
                border-radius: 1rem;
                box-shadow: 0 2px 16px rgba(0, 0, 0, 0.07);
            }

            .custom-feature-check .form-check-input {
                margin-top: 0.2rem;
                margin-right: 0.5rem;
            }

            .custom-feature-check .form-check-label {
                font-size: 0.97rem;
                font-weight: 500;
            }

            @media (max-width: 767.98px) {
                .advanced-search-form {
                    padding: 1.5rem 0.7rem;
                }

                .custom-feature-check .form-check-label {
                    font-size: 0.95rem;
                }
            }
        </style>
        <!-- ##### Advance Search Area End ##### -->

        <!-- ##### Featured Properties Area Start ##### -->
        <section class="featured-properties-area section-padding-100-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading wow fadeInUp">
                            <h2>Featured Properties</h2>
                            <p>Suspendisse dictum enim sit amet libero malesuada feugiat.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($properties as $property)
                            <!-- Single Featured Property -->

                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="single-featured-property mb-50 wow fadeInUp" data-wow-delay="100ms">
                                    <!-- Property Thumbnail -->
                                    <div class="property-thumb">
                                        <a href="{{ route('website.property', $property->id) }}">
                                        @if ($property->images->isEmpty())
                                            <img src="{{ asset('assets/website/img/bg-img/no-image.png') }}" alt="">
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
                                            <p><i class="fa fa-dollar-sign"></i> {{ $property->price }}</p>
                                        </div>
                                    </div>
                                    <!-- Property Content -->
                                    <div class="property-content">
                                        <h5>{{ $property->title }}</h5>
                                        <p class="location"><img src="{{ asset('assets/website/img/icons/location.png') }}"
                                                alt="">{{ $property->address }}, {{ $property->city }},
                                            {{ $property->state }},{{ $property->country }}</p>
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
                                            <div class="bedrooms">
                                                <img src="{{ asset('assets/website/img/icons/bed.png') }}" alt="">
                                                <span>{{ $property->bedrooms }}</span>
                                            </div>
                                            <div class="space">
                                                <img src="{{ asset('assets/website/img/icons/space.png') }}" alt="">
                                                <span>{{ $property->size }} sq ft</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ##### Featured Properties Area End ##### -->

        <!-- ##### Call To Action Area Start ##### -->
        <section class="call-to-action-area bg-fixed bg-overlay-black"
            style="background-image: {{ asset('assets/website/img/bg-img/cta.jpg') }}">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-12">
                        <div class="cta-content text-center">
                            <h2 class="wow fadeInUp" data-wow-delay="300ms">Are you looking for a place to rent?</h2>
                            <h6 class="wow fadeInUp" data-wow-delay="400ms">Suspendisse dictum enim sit amet libero
                                malesuada feugiat.</h6>
                            <a href="#" class="btn south-btn mt-50 wow fadeInUp" data-wow-delay="500ms">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Call To Action Area End ##### -->

        <!-- ##### Testimonials Area Start ##### -->
        <section class="south-testimonials-area section-padding-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading wow fadeInUp" data-wow-delay="250ms">
                            <h2>Client testimonials</h2>
                            <p>Suspendisse dictum enim sit amet libero malesuada feugiat.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="testimonials-slides owl-carousel wow fadeInUp" data-wow-delay="500ms">

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide text-center">
                                <h5>Perfect Home for me</h5>
                                <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus
                                    blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et
                                    tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic
                                    iturut magna.</p>

                                <div class="testimonial-author-info">
                                    <img src="{{ asset('assets/website/img/bg-img/feature6.jpg') }}" alt="">
                                    <p>Daiane Smith, <span>Customer</span></p>
                                </div>
                            </div>

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide text-center">
                                <h5>Perfect Home for me</h5>
                                <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus
                                    blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et
                                    tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic
                                    iturut magna.</p>

                                <div class="testimonial-author-info">
                                    <img src="{{ asset('assets/website/img/bg-img/feature6.jpg') }}" alt="">
                                    <p>Daiane Smith, <span>Customer</span></p>
                                </div>
                            </div>

                            <!-- Single Testimonial Slide -->
                            <div class="single-testimonial-slide text-center">
                                <h5>Perfect Home for me</h5>
                                <p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus
                                    blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et
                                    tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic
                                    iturut magna.</p>

                                <div class="testimonial-author-info">
                                    <img src="{{ asset('assets/website/img/bg-img/feature6.jpg') }}" alt="">
                                    <p>Daiane Smith, <span>Customer</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Testimonials Area End ##### -->

        <!-- ##### Editor Area Start ##### -->
        <section class="south-editor-area d-flex align-items-center">
            <!-- Editor Content -->
            <div class="editor-content-area">
                <!-- Section Heading -->
                <div class="section-heading wow fadeInUp" data-wow-delay="250ms">
                    <img src="{{ asset('assets/website/img/icons/prize.png') }}" alt="">
                    <h2>jeremy Scott</h2>
                    <p>Realtor</p>
                </div>
                <p class="wow fadeInUp" data-wow-delay="500ms">Etiam nec odio vestibulum est mattis effic iturut magna.
                    Pellentesque sit amet tellus blandit. Etiam nec odiomattis effic iturut magna. Pellentesque sit am et
                    tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.
                    Curabitur rhoncus auctor eleifend. Fusce venenatis diam urna, eu pharetra arcu varius ac. Etiam cursus
                    turpis lectus, id iaculis risus tempor id. Phasellus fringilla nisl sed sem scelerisque, eget aliquam
                    magna vehicula.</p>
                <div class="address wow fadeInUp" data-wow-delay="750ms">
                    <h6><img src="{{ asset('assets/website/img/icons/phone-call.png') }}" alt=""> +45 677 8993000
                        223
                    </h6>
                    <h6><img src="{{ asset('assets/website/img/icons/envelope.png') }}" alt="">
                        office@template.com
                    </h6>
                </div>
                <div class="signature mt-50 wow fadeInUp" data-wow-delay="1000ms">
                    <img src="{{ asset('assets/website/img/core-img/signature.png') }}" alt="">
                </div>
            </div>

            <!-- Editor Thumbnail -->
            <div class="editor-thumbnail">
                <img src="{{ asset('assets/website/img/bg-img/editor.jpg') }}" alt="">
            </div>
        </section>
        <!-- ##### Editor Area End ##### -->
        <style>
            .property-thumb img {
                width: 100%;
                height: 220px;
                object-fit: cover;
                border-radius: 0.5rem 0.5rem 0 0;
                background: #f8f9fa;
            }
        </style>

@endsection
