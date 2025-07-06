@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        #mapid {
            min-height: 500px;
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

        /* Inquiry styles */
        .message-preview {
            max-width: 300px;
            word-wrap: break-word;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .btn-group .btn {
            margin-right: 2px;
        }

        .btn-group .btn:last-child {
            margin-right: 0;
        }

        .inquiry-stats .card {
            transition: transform 0.2s ease;
        }

        .inquiry-stats .card:hover {
            transform: translateY(-2px);
        }

        .modal-body .bg-light {
            background-color: #f8f9fa !important;
            border: 1px solid #e9ecef;
        }

        .text-decoration-none:hover {
            text-decoration: underline !important;
        }


    </style>
@endpush
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
                                                        <li><strong>Owner:</strong> {{ $property->agent->name ?? 'N/A' }}
                                                        </li>
                                                        <li><strong>Contact:</strong>
                                                            {{ $property->agent->email ?? 'N/A' }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Property Inquiries -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <i class="mdi mdi-message-text text-primary me-2"></i>
                                                Property Inquiries ({{ $property->inquiries->count() }})
                                            </h4>





                                            @if ($property->inquiries->count() > 0)
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Message</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($property->inquiries->sortByDesc('created_at') as $inquiry)
                                                                <tr>
                                                                    <td>
                                                                        <small class="text-muted">
                                                                            {{ $inquiry->created_at->format('M d, Y') }}
                                                                            <br>
                                                                            <span class="text-muted">{{ $inquiry->created_at->format('h:i A') }}</span>
                                                                        </small>
                                                                    </td>
                                                                    <td>
                                                                        <strong>{{ $inquiry->name }}</strong>
                                                                    </td>
                                                                    <td>
                                                                        @if ($inquiry->email)
                                                                            <a href="mailto:{{ $inquiry->email }}" class="text-decoration-none">
                                                                                {{ $inquiry->email }}
                                                                            </a>
                                                                        @else
                                                                            <span class="text-muted">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($inquiry->phone)
                                                                            <a href="tel:{{ $inquiry->phone }}" class="text-decoration-none">
                                                                                {{ $inquiry->phone }}
                                                                            </a>
                                                                        @else
                                                                            <span class="text-muted">N/A</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <div class="message-preview">
                                                                            {{ Str::limit($inquiry->message, 30) }}
                                                                            @if (strlen($inquiry->message) > 30)
                                                                                <button type="button" class="btn btn-link btn-sm p-0 ms-1"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#messageModal{{ $inquiry->id }}">
                                                                                    Read more
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                                                                                        <td>
                                                                        <div class="btn-group" role="group">
                                                                            @if ($inquiry->email)
                                                                                <a href="mailto:{{ $inquiry->email }}?subject=Re: Inquiry about {{ $property->title }}"
                                                                                   class="btn btn-outline-primary btn-sm"
                                                                                   title="Reply via Email">
                                                                                    <i class="mdi mdi-email"></i>
                                                                                </a>
                                                                            @endif
                                                                            @if ($inquiry->phone)
                                                                                <a href="tel:{{ $inquiry->phone }}"
                                                                                   class="btn btn-outline-success btn-sm"
                                                                                   title="Call">
                                                                                    <i class="mdi mdi-phone"></i>
                                                                                </a>
                                                                            @endif



                                                                            <form id="deleteInquiryForm" method="POST"
                                                                                action="{{ route('auth.inquiries.destroy', ['id' => $inquiry->id]) }}">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <!-- Message Modal -->
                                                                <div class="modal fade" id="messageModal{{ $inquiry->id }}" tabindex="-1"
                                                                     aria-labelledby="messageModalLabel{{ $inquiry->id }}" aria-hidden="true">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="messageModalLabel{{ $inquiry->id }}">
                                                                                    Message from {{ $inquiry->name }}
                                                                                </h5>
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row mb-3">
                                                                                    <div class="col-md-6">
                                                                                        <strong>Date:</strong> {{ $inquiry->created_at->format('M d, Y h:i A') }}
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <strong>Property:</strong> {{ $property->title }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row mb-3">
                                                                                    <div class="col-md-4">
                                                                                        <strong>Name:</strong> {{ $inquiry->name }}
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <strong>Email:</strong>
                                                                                        @if ($inquiry->email)
                                                                                            <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                                                                                        @else
                                                                                            N/A
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <strong>Phone:</strong>
                                                                                        @if ($inquiry->phone)
                                                                                            <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                                                                                        @else
                                                                                            N/A
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="message-content">
                                                                                    <strong>Message:</strong>
                                                                                    <div class="mt-2 p-3 bg-light rounded">
                                                                                        {{ nl2br(e($inquiry->message)) }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                @if ($inquiry->email)
                                                                                    <a href="mailto:{{ $inquiry->email }}?subject=Re: Inquiry about {{ $property->title }}&body=Dear {{ $inquiry->name }},%0D%0A%0D%0AThank you for your inquiry about {{ $property->title }}.%0D%0A%0D%0A"
                                                                                       class="btn btn-primary">
                                                                                        <i class="mdi mdi-email"></i> Reply via Email
                                                                                    </a>
                                                                                @endif
                                                                                <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal" >Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- Inquiry Statistics -->
                                                <div class="row mt-3 inquiry-stats">
                                                    <div class="col-md-3">
                                                        <div class="card bg-primary text-white">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">{{ $property->inquiries->count() }}</h5>
                                                                <p class="card-text">Total Inquiries</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="card bg-success text-white">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">{{ $property->inquiries->where('created_at', '>=', now()->subDays(7))->count() }}</h5>
                                                                <p class="card-text">This Week</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="card bg-warning text-white">
                                                            <div class="card-body text-center">
                                                                <h5 class="card-title">{{ $property->inquiries->where('created_at', '>=', now()->subDays(1))->count() }}</h5>
                                                                <p class="card-text">Today</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-center py-4">
                                                    <i class="mdi mdi-message-text-outline text-muted" style="font-size: 48px;"></i>
                                                    <h5 class="text-muted mt-3">No Inquiries Yet</h5>
                                                    <p class="text-muted">This property hasn't received any inquiries yet.</p>
                                                </div>
                                            @endif
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
                                                @if ($property->is_published == 0)
                                                    @haspermission('publish properties')
                                                        <a href="{{ route('auth.properties.publish', $property->id) }}"
                                                            class="btn btn-info">
                                                            <i class="fa fa-globe"></i>Publish Property
                                                        </a>
                                                    @endhaspermission
                                                @endif
                                                <a href="{{ route('auth.properties.manage') }}" class="btn btn-light">
                                                    <i class="fa fa-arrow-left"></i> Back to Properties
                                                </a>
                                            @endif
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

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
