@extends('layouts.admin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">{{ $property->title ?? 'Property Details' }}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('auth.properties.manage') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $property->title ?? 'Property Details' }}</li>
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
                                                    @if(isset($property->status))
                                                        <span class="badge bg-{{ $property->status === 'available' ? 'success' : 'warning' }}">
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
                                                    @if(isset($property->price))
                                                        ${{ number_format((float)$property->price, 2) }}
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
                                                    @if(isset($property->size))
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
                                                    @if(isset($property->features) && is_string($property->features))
                                                        @php
                                                            $features = json_decode($property->features);
                                                        @endphp
                                                        @if(is_array($features))
                                                            @foreach($features as $feature)
                                                                <span class="badge bg-info me-1">{{ $feature }}</span>
                                                            @endforeach
                                                        @else
                                                            N/A
                                                        @endif
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

                        @if(isset($property->images) && is_string($property->images))
                            @php
                                $images = json_decode($property->images);
                            @endphp
                            @if(is_array($images) && !empty($images))
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h4 class="card-title">Property Images</h4>
                                    <div class="row">
                                        @foreach($images as $image)
                                        <div class="col-md-3 mb-3">
                                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded" alt="Property Image">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
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
                                                    <li><strong>Created:</strong> {{ $property->created_at->format('M d, Y') }}</li>
                                                    <li><strong>Last Updated:</strong> {{ $property->updated_at->format('M d, Y') }}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Contact Information</h5>
                                                <ul class="list-unstyled">
                                                    <li><strong>Owner:</strong> {{ $property->owner->name ?? 'N/A' }}</li>
                                                    <li><strong>Contact:</strong> {{ $property->owner->email ?? 'N/A' }}</li>
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
                                        @if(isset($property->id))
                                            <a href="{{ route('auth.properties.edit', ['id' => $property->id]) }}" class="btn btn-primary me-2">
                                                <i class="fa fa-edit"></i> Edit Property
                                            </a>
                                            <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#deletePropertyModal">
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
@if(isset($property->id))
<div class="modal fade" id="deletePropertyModal" tabindex="-1" aria-labelledby="deletePropertyModalLabel" aria-hidden="true">
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
                <form action="{{ route('auth.properties.destroy', ['id' => $property->id]) }}" method="POST" class="d-inline">
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
</script>
@endpush
