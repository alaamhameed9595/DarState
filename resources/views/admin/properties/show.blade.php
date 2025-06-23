@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">{{ $property->title ?? 'Property Details' }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('auth.properties.manage') }}">Properties</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $property->title ?? 'Property Details' }}
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Basic Information</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Title</th>
                                                    <td>{{ $property->title ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td>{{ $property->type ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>
                                                        @if (isset($property->status))
                                                            <span
                                                                class="badge bg-{{ $property->status === 'available' ? 'success' : 'warning' }}">
                                                                {{ ucfirst($property->status) }}
                                                            </span>
                                                        @else
                                                            <span class="badge bg-secondary">N/A</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Price</th>
                                                    <td>
                                                        @if (isset($property->price))
                                                            ${{ number_format((float) $property->price, 2) }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title">Location Details</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Address</th>
                                                    <td>{{ $property->address ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>City</th>
                                                    <td>{{ $property->city ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <td>{{ $property->state ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country</th>
                                                    <td>{{ $property->country ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h4 class="card-title">Property Specifications</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Bedrooms</th>
                                                    <td>{{ $property->bedrooms ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bathrooms</th>
                                                    <td>{{ $property->bathrooms ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Size</th>
                                                    <td>
                                                        @if (isset($property->size))
                                                            {{ $property->size }} sq ft
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Year Built</th>
                                                    <td>{{ $property->year_built ?? 'N/A' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="card-title">Additional Information</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Description</th>
                                                    <td>{{ $property->description ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Features</th>
                                                    <td>
                                                        @if ($property->features->count() > 0)
                                                            @foreach ($property->features as $feature)
                                                                <span
                                                                    class="badge bg-info me-1">{{ $feature->name }}</span>
                                                            @endforeach
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @if ($property->images->count() > 0)
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h4 class="card-title">
                                            <i class="mdi mdi-image-multiple text-primary me-2"></i>
                                            Property Images ({{ $property->images->count() }})
                                        </h4>
                                        <div class="row">
                                            @foreach ($property->images as $index => $image)
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-3">
                                                    <div class="property-image-container">
                                                        <div class="image-wrapper" data-bs-toggle="modal"
                                                            data-bs-target="#imageModal{{ $index }}">
                                                            <img src="{{ $image->image_url }}"
                                                                class="img-fluid rounded shadow-sm property-image"
                                                                alt="Property Image {{ $index + 1 }}"
                                                                style="width: 100%; height: 200px; object-fit: cover; cursor: pointer; transition: transform 0.3s ease;">
                                                            <div class="image-overlay">
                                                                <i class="mdi mdi-magnify-plus text-white"
                                                                    style="font-size: 24px;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Individual Image Modal -->
                                                <div class="modal fade" id="imageModal{{ $index }}" tabindex="-1"
                                                    aria-labelledby="imageModalLabel{{ $index }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="imageModalLabel{{ $index }}">
                                                                    Property Image {{ $index + 1 }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center p-0">
                                                                <div class="image-zoom-container">
                                                                    <img src="{{ $image->image_url }}"
                                                                        class="img-fluid modal-image"
                                                                        alt="Property Image {{ $index + 1 }}"
                                                                        style="max-width: 100%; max-height: 70vh; object-fit: contain;">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center w-100">
                                                                    <div>
                                                                        @if ($index > 0)
                                                                            <button type="button"
                                                                                class="btn btn-outline-primary btn-sm"
                                                                                onclick="showImage({{ $index - 1 }})">
                                                                                <i class="mdi mdi-chevron-left"></i>
                                                                                Previous
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                    <div class="image-counter">
                                                                        {{ $index + 1 }} of
                                                                        {{ $property->images->count() }}
                                                                    </div>
                                                                    <div>
                                                                        @if ($index < $property->images->count() - 1)
                                                                            <button type="button"
                                                                                class="btn btn-outline-primary btn-sm"
                                                                                onclick="showImage({{ $index + 1 }})">
                                                                                Next <i class="mdi mdi-chevron-right"></i>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Image Gallery Navigation -->
                                        @if ($property->images->count() > 1)
                                            <div class="text-center mt-3">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-outline-primary btn-sm"
                                                        onclick="showAllImages()">
                                                        <i class="mdi mdi-view-grid"></i> View All
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm"
                                                        onclick="downloadAllImages()">
                                                        <i class="mdi mdi-download"></i> Download All
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <!-- map Information -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">location</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="map" style="height: 400px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Additional Property Information -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Additional Details</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Property History</h5>
                                                    <ul class="list-unstyled">
                                                        <li><strong>Created:</strong>
                                                            {{ $property->created_at->format('M d, Y') }}</li>
                                                        <li><strong>Last Updated:</strong>
                                                            {{ $property->updated_at->format('M d, Y') }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Contact Information</h5>
                                                    <ul class="list-unstyled">
                                                        <li><strong>Owner:</strong> {{ $property->owner->name ?? 'N/A' }}
                                                        </li>
                                                        <li><strong>Contact:</strong>
                                                            {{ $property->owner->email ?? 'N/A' }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if (isset($property->id))
                                                <a href="{{ route('auth.properties.edit', ['id' => $property->id]) }}"
                                                    class="btn btn-primary me-2">
                                                    <i class="fa fa-edit"></i> Edit Property
                                                </a>
                                                <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal"
                                                    data-bs-target="#deletePropertyModal">
                                                    <i class="fa fa-trash"></i> Delete Property
                                                </button>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('auth.properties.manage') }}" class="btn btn-light">
                                                <i class="fa fa-arrow-left"></i> Back to Properties
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Property Modal -->
    @if (isset($property->id))
        <div class="modal fade" id="deletePropertyModal" tabindex="-1" aria-labelledby="deletePropertyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePropertyModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this property? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('auth.properties.destroy', ['id' => $property->id]) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Property</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
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

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let map, markers = [];
            /* ----------------------------- Initialize Map ----------------------------- */
            function initMap() {
                map = L.map('map', {
                    center: {
                        lat: 28.626137,
                        lng: 79.821603,
                    },
                    zoom: 15
                });

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                map.on('click', mapClicked);
                initMarkers();
            }
            initMap();

            /* --------------------------- Initialize Markers --------------------------- */
            function initMarkers() {
                const initialMarkers = <?php echo json_encode($initialMarkers); ?>;

                for (let index = 0; index < initialMarkers.length; index++) {

                    const data = initialMarkers[index];
                    const marker = generateMarker(data, index);
                    marker.addTo(map).bindPopup(`<b>${data.position.lat},  ${data.position.lng}</b>`);
                    map.panTo(data.position);
                    markers.push(marker)
                }
            }

            function generateMarker(data, index) {
                return L.marker(data.position, {
                        draggable: data.draggable
                    })
                    .on('click', (event) => markerClicked(event, index))
                    .on('dragend', (event) => markerDragEnd(event, index));
            }

            /* ------------------------- Handle Map Click Event ------------------------- */
            function mapClicked($event) {
                console.log(map);
                console.log($event.latlng.lat, $event.latlng.lng);
            }

            /* ------------------------ Handle Marker Click Event ----------------------- */
            function markerClicked($event, index) {
                console.log(map);
                console.log($event.latlng.lat, $event.latlng.lng);
            }

            /* ----------------------- Handle Marker DragEnd Event ---------------------- */
            function markerDragEnd($event, index) {
                console.log(map);
                console.log($event.target.getLatLng());
            }
        });
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px !important;
            width: 100%;
            min-height: 300px;
            z-index: 1;
        }

        .property-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .property-image-container:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .image-wrapper {
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .image-wrapper:hover {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 8px;
        }

        .image-wrapper:hover .image-overlay {
            opacity: 1;
        }

        .property-image {
            transition: transform 0.3s ease;
        }

        .modal-image {
            cursor: zoom-in;
            transition: transform 0.3s ease;
        }

        .modal-image:hover {
            transform: scale(1.1);
        }

        .image-zoom-container {
            position: relative;
            overflow: hidden;
            background: #f8f9fa;
            min-height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-counter {
            font-weight: 500;
            color: #6c757d;
        }

        .modal-dialog.modal-lg {
            max-width: 90%;
        }

        .modal-body {
            padding: 0 !important;
        }

        .modal-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            background: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-dialog.modal-lg {
                max-width: 95%;
                margin: 10px;
            }

            .image-zoom-container {
                min-height: 300px;
            }

            .modal-image {
                max-height: 60vh !important;
            }
        }

        /* Loading animation for images */
        .property-image {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .property-image[src] {
            animation: none;
        }
    </style>
@endpush
