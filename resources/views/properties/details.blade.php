@extends('layouts.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Property Details</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('auth.properties.manage') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Property Details</li>
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
                                                    @if($property->features->count() > 0)
                                                        @foreach($property->features as $feature)
                                                            <span class="badge bg-info me-1">{{ $feature->name }}</span>
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

                        @if($property->images->count() > 0)
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h4 class="card-title">Property Images</h4>
                                    <div class="row">
                                        @foreach($property->images as $image)
                                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                                <img src="{{ $image->image_url }}"
                                                     class="img-fluid rounded"
                                                     alt="Property Image"
                                                     style="width: 100%; height: 200px; object-fit: cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row mt-4">
                            <div class="col-12">
                                @if(isset($property->id))
                                    <a href="{{ route('auth.properties.edit', $property->id) }}" class="btn btn-primary me-2">Edit Property</a>
                                @endif
                                <a href="{{ route('auth.properties.manage') }}" class="btn btn-light">Back to Properties</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
