@extends('layouts.website')
@section('title', 'About Us | DarState')
@section('meta_description', 'Learn more about DarState, your trusted real estate partner.')
@section('meta_keywords', 'about, real estate, DarState')
@section('og_title', 'About Us | DarState')
@section('og_description', 'Learn more about DarState, your trusted real estate partner.')
@section('og_image', asset('assets/website/img/bg-img/about.jpg'))
@section('styles')
@endsection
@section('content')

    <!-- ##### About Content Wrapper Start ##### -->
    <section class="about-content-wrapper section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
                        <h2>We search for the perfect home</h2>
                        <p>Suspendisse dictum enim sit amet libero</p>
                    </div>
                    <div class="about-content">
                        <img class="wow fadeInUp" data-wow-delay="350ms"
                            src="{{ asset('assets/website/img/bg-img/about.jpg') }}" alt="">
                        <p class="wow fadeInUp" data-wow-delay="450ms">Integer nec bibendum lacus. Suspendisse dictum enim
                            sit amet libero malesuada. Integer nec bibendum lacus. Suspendisse dictum enim sit amet libero
                            malesuada feugiat. Praesent malesuada congue magna at finibus. In hac habitasse platea dictumst.
                            Curabitur rhoncus auctor eleifend. Fusce venenatis diam urna, eu pharetra arcu varius ac. Etiam
                            cursus turpis lectus, id iaculis risus tempor id. Phasellus fringilla nisl sed sem scelerisque,
                            eget aliquam magna vehicula.</p>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
                        <h2>Featured Properties</h2>
                    </div>

                    <div class="featured-properties-slides owl-carousel wow fadeInUp" data-wow-delay="350ms">
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
                                            <img src="{{ asset('assets/website/img/icons/bathtub.png') }}" alt="">
                                            <span>{{ $property->bathrooms }}</span>
                                        </div>
                                        <div class="bed">
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
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### About Content Wrapper End ##### -->

    <!-- ##### Call To Action Area Start ##### -->
    <section class="call-to-action-area bg-fixed bg-overlay-black" style="background-image: url(img/bg-img/cta.jpg)">
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-12">
                    <div class="cta-content text-center">
                        <h2 class="wow fadeInUp" data-wow-delay="300ms">Are you looking for a place to rent?</h2>
                        <h6 class="wow fadeInUp" data-wow-delay="400ms">Suspendisse dictum enim sit amet libero malesuada
                            feugiat.</h6>
                        <a href="{{ route('properties.index') }}" class="btn south-btn mt-50 wow fadeInUp"
                            data-wow-delay="500ms">Search</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Call To Action Area End ##### -->

    <!-- ##### Meet The Team Area Start ##### -->
    <section class="meet-the-team-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h2>Meet The Team</h2>
                        <p>Suspendisse dictum enim sit amet libero</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Single Team Member -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-team-member mb-100 wow fadeInUp" data-wow-delay="250ms">
                        <!-- Team Member Thumb -->
                        <div class="team-member-thumb">
                            <img src="{{ asset('assets/website/img/bg-img/team1.jpg') }}" alt="">
                        </div>
                        <!-- Team Member Info -->
                        <div class="team-member-info">
                            <div class="section-heading">
                                <img src="{{ asset('assets/website/img/icons/prize.png') }}" alt="">
                                <h2>Jeremy Scott</h2>
                                <p>Realtor</p>
                            </div>
                            <div class="address">
                                <h6><img src="{{ asset('assets/website/img/icons/phone-call.png') }}" alt=""> +45
                                    677 8993000 223</h6>
                                <h6><img src="{{ asset('assets/website/img/icons/envelope.png') }}" alt="">
                                    office@template.com</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Team Member -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-team-member mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <!-- Team Member Thumb -->
                        <div class="team-member-thumb">
                            <img src="{{ asset('assets/website/img/bg-img/team2.jpg') }}" alt="">
                        </div>
                        <!-- Team Member Info -->
                        <div class="team-member-info">
                            <div class="section-heading">
                                <img src="{{ asset('assets/website/img/icons/prize.png') }}" alt="">
                                <h2>Maria Williams</h2>
                                <p>Realtor</p>
                            </div>
                            <div class="address">
                                <h6><img src="{{ asset('assets/website/img/icons/phone-call.png') }}" alt=""> +45
                                    677 8993000 223</h6>
                                <h6><img src="{{ asset('assets/website/img/icons/envelope.png') }}" alt="">
                                    office@template.com</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Team Member -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-team-member mb-100 wow fadeInUp" data-wow-delay="750ms">
                        <!-- Team Member Thumb -->
                        <div class="team-member-thumb">
                            <img src="{{ asset('assets/website/img/bg-img/team3.jpg') }}" alt="">
                        </div>
                        <!-- Team Member Info -->
                        <div class="team-member-info">
                            <div class="section-heading">
                                <img src="{{ asset('assets/website/img/icons/prize.png') }}" alt="">
                                <h2>Patrick Joe</h2>
                                <p>Realtor</p>
                            </div>
                            <div class="address">
                                <h6><img src="{{ asset('assets/website/img/icons/phone-call.png') }}" alt=""> +45
                                    677 8993000 223</h6>
                                <h6><img src="{{ asset('assets/website/img/icons/envelope.png') }}" alt="">
                                    office@template.com</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Meet The Team Area End ##### -->


@endsection
@section('scripts')

@endsection
