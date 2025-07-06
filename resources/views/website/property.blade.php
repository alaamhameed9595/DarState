@extends('layouts.website')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #mapid {
            min-height: 500px;
        }

        .property-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            background: #fff;
            margin-bottom: 1.5rem;
            transition: box-shadow 0.3s;
        }

        .property-image-container:hover {
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.18);
        }

        .image-wrapper {
            position: relative;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .image-wrapper:hover {
            transform: scale(1.04);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 12px;
        }

        .image-wrapper:hover .image-overlay {
            opacity: 1;
        }

        .property-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 12px;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        .property-image[src] {
            animation: none;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .modal-dialog.modal-lg {
            max-width: 90%;
        }

        .modal-body {
            padding: 0 !important;
        }

        .modal-header,
        .modal-footer {
            background: #f8f9fa;
            border: none;
        }

        .image-zoom-container {
            background: #f8f9fa;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-image {
            max-width: 100%;
            max-height: 70vh;
            border-radius: 8px;
            transition: transform 0.3s;
        }

        .modal-image:hover {
            transform: scale(1.08);
        }

        .image-counter {
            font-weight: 500;
            color: #6c757d;
        }

        @media (max-width: 768px) {
            .modal-dialog.modal-lg {
                max-width: 98%;
                margin: 10px;
            }

            .image-zoom-container {
                min-height: 220px;
            }

            .modal-image {
                max-height: 50vh !important;
            }
        }

        .btn-outline-primary,
        .btn-outline-secondary {
            border-radius: 20px;
            padding: 0.375rem 1.25rem;
        }

        .btn-outline-primary i,
        .btn-outline-secondary i {
            vertical-align: middle;
        }
    </style>
@endpush
@section('content')
    <!-- ##### Listings Content Area Start ##### -->
    <section class="listings-content-wrapper section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Single Listings Slides -->
                    <div class="single-listings-sliders owl-carousel">
                        @if ($property->images->isEmpty())
                            <div class="image-wrapper">
                                <img src="{{ asset('img/bg-img/hero4.jpg') }}" alt="No Image Available"
                                    class="property-image">
                                <div class="image-overlay">
                                    <span>No Images Available</span>
                                </div>
                            </div>
                        @else
                            @foreach ($property->images as $index => $image)
                                <div class="image-wrapper" onclick="showImage({{ $index }})">
                                    <img src="{{ $image['image_url'] }}" alt="Property Image" class="property-image">
                                    <div class="image-overlay">
                                        <span>Click to view</span>
                                    </div>
                                </div>

                                <!-- Modal for each image -->
                                <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1"
                                    aria-labelledby="imageModalLabel{{ $index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="imageModalLabel{{ $index }}">Property
                                                    Image
                                                    {{ $index + 1 }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body image-zoom-container">
                                                <img src="{{ $image['image_url'] }}" alt="Property Image"
                                                    class="modal-image">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-outline-primary"
                                                    onclick="downloadImage('{{ $image->image_url }}')">
                                                    <i class="fa fa-download"></i> Download Image
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="listings-content">
                        <!-- Price -->
                        <div class="list-price">
                            <p>{{ $property->price }}</p>
                        </div>
                        <h5>{{ $property->title }}</h5>
                        <p class="location"><img src="{{ asset('assets/website/img/icons/location.png') }}"
                                alt="">{{ $property->address }} , {{ $property->city }} ,
                            {{ $property->country }}</p>
                        <p>{{ $property->description }}</p>
                        <!-- Meta -->
                        <div class="property-meta-data d-flex align-items-end">
                            <div class="new-tag">
                                <img src="{{ asset('assets/website/img/icons/new.png') }}" alt="">
                            </div>
                            <div class="bathroom">
                                <img src="{{ asset('assets/website/img/icons/bathtub.png') }}" alt="">
                                <span>{{ $property->bathrooms }}</span>
                            </div>
                            <div class="garage">
                                <img src="{{ asset('assets/website/img/icons/bed.png') }}" alt="">
                                <span>{{ $property->bedrooms }}</span>
                            </div>
                            <div class="space">
                                <img src="{{ asset('assets/website/img/icons/space.png') }}" alt="">
                                <span>{{ $property->size }} sq ft</span>
                            </div>
                        </div>
                        <!-- Core Features -->
                        <ul class="listings-core-features d-flex align-items-center">
                            @foreach ($property->features as $feature)
                                <li><i class="fa fa-check" aria-hidden="true"></i> {{ $feature->name }}</li>
                            @endforeach

                        </ul>

                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-realtor-wrapper">
                        <div class="realtor-info">
                            <img src="img/bg-img/listing.jpg" alt="">
                            <div class="realtor---info">
                                <h2>{{ $property->agent->agency_name }}</h2>
                                <p>Realtor</p>
                                <h6><img src="img/icons/envelope.png" alt=""> {{ $property->agent->email }}</h6>
                            </div>
                            <div class="realtor--contact-form">
                                <form action="{{ route('inquiry.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" id="realtor-name"
                                            placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" accept="tel" pattern="[0-9]*"  class="form-control" name="phone" id="realtor-number"
                                            placeholder="Your Number">
                                    </div>
                                    <div class="form-group">
                                        <input type="enumber" class="form-control" name="email" id="realtor-email"
                                            placeholder="Your Mail">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" name="message" class="form-control" id="realtor-message" cols="30" rows="10"
                                            placeholder="Your Message"></textarea>
                                    </div>
                                    <input type="hidden" name="property_id" value="{{ $property->id }}">
                                    <input type="hidden" name="title" value="{{ $property->title }}">
                                 <button type="submit" class="btn south-btn">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Listing Maps -->
            <div class="row">
                <div class="col-12">
                    <div class="listings-maps mt-100">
                        <div id="googleMap"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Listings Content Area End ##### -->
@endsection

@push('scripts')
    <script>
        // Initialize any JavaScript components here
        document.addEventListener('DOMContentLoaded', function() {
            // Add any additional JavaScript functionality
        });

        // Image gallery functionality
        function showImage(index) {
            // Close current modal
            const currentModal = document.querySelector('.modal.show');
            if (currentModal) {
                const modalInstance = bootstrap.Modal.getInstance(currentModal);
                modalInstance.hide();
            }

            // Show new modal after a short delay
            setTimeout(() => {
                const newModal = document.getElementById(`imageModal${index}`);
                if (newModal) {
                    const modalInstance = new bootstrap.Modal(newModal);
                    modalInstance.show();
                }
            }, 300);
        }

        function showAllImages() {
            // Show first image modal
            const firstModal = document.getElementById('imageModal0');
            if (firstModal) {
                const modalInstance = new bootstrap.Modal(firstModal);
                modalInstance.show();
            }
        }

        function downloadAllImages() {
            // Get all image URLs
            const images = @json($property->images->pluck('image_url'));

            // Create download links for each image
            images.forEach((imageUrl, index) => {
                const link = document.createElement('a');
                link.href = imageUrl;
                link.download = `property_image_${index + 1}.jpg`;
                link.target = '_blank';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        }

        // Add hover effects for image containers
        document.addEventListener('DOMContentLoaded', function() {
            const imageWrappers = document.querySelectorAll('.image-wrapper');

            imageWrappers.forEach(wrapper => {
                wrapper.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });

                wrapper.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>
@endpush
