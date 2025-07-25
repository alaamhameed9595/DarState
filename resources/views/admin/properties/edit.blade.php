@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/property-forms.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Edit Property
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('auth.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('auth.properties.manage') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Property</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4 class="card-title mb-0">
                            <i class="mdi mdi-pencil me-2"></i>
                            Edit Property Information
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('auth.properties.update', $property->id) }}" method="POST"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')



                            <!-- Basic Information Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="mdi mdi-information-outline text-primary me-2"></i>
                                    Basic Information
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="form-label fw-bold">
                                                <i class="mdi mdi-format-title text-muted me-1"></i>
                                                Property Title
                                            </label>
                                            <input type="text" name="title" id="title"
                                                class="form-control form-control-lg @error('title') is-invalid @enderror"
                                                value="{{ old('title', $property->title) }}" required
                                                placeholder="Enter property title">
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type" class="form-label fw-bold">
                                                <i class="mdi mdi-home-city text-muted me-1"></i>
                                                Property Type
                                            </label>
                                            <select name="type" id="type"
                                                class="form-select form-select-lg @error('type') is-invalid @enderror"
                                                required>
                                                <option value="">Select Property Type</option>
                                                <option value="apartment"
                                                    {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-office-building"></i> Apartment
                                                </option>
                                                <option value="house"
                                                    {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-home"></i> House
                                                </option>
                                                <option value="villa"
                                                    {{ old('type', $property->type) == 'villa' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-home-variant"></i> Villa
                                                </option>
                                                <option value="cottage"
                                                    {{ old('type', $property->type) == 'cottage' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-home-modern"></i> Cottage
                                                </option>
                                                <option value="land"
                                                    {{ old('type', $property->type) == 'land' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-home-modern"></i> Land
                                                </option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="description" class="form-label fw-bold">
                                        <i class="mdi mdi-text text-muted me-1"></i>
                                        Description
                                    </label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        rows="4" required placeholder="Describe your property in detail...">{{ old('description', $property->description) }}</textarea>
                                    <div class="form-text">
                                        <i class="mdi mdi-information-outline me-1"></i>
                                        Provide a detailed description of your property (10-1000 characters)
                                    </div>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            <i class="mdi mdi-alert-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pricing & Status Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="mdi mdi-currency-usd text-success me-2"></i>
                                    Pricing & Status
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="price" class="form-label fw-bold">
                                                <i class="mdi mdi-tag text-success me-1"></i>
                                                Price
                                            </label>
                                            <div class="input-group input-group-lg">
                                                <span class="input-group-text bg-success text-white">
                                                    <i class="mdi mdi-currency-usd"></i>
                                                </span>
                                                <input type="number" name="price" id="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price', $property->price) }}" min="0"
                                                    step="0.01" required placeholder="0.00">
                                            </div>
                                            @error('price')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="process_type" class="form-label fw-bold">
                                                <i class="mdi mdi-swap-horizontal text-info me-1"></i>
                                                Transaction Type
                                            </label>
                                            <select name="process_type" id="process_type"
                                                class="form-select form-select-lg @error('process_type') is-invalid @enderror"
                                                required>
                                                <option value="">Select Type</option>
                                                <option value="1"
                                                    {{ old('process_type', $property->process_type) == 1 ? 'selected' : '' }}>
                                                    <i class="mdi mdi-key"></i> For Rent
                                                </option>
                                                <option value="0"
                                                    {{ old('process_type', $property->process_type) == 0 ? 'selected' : '' }}>
                                                    <i class="mdi mdi-cash"></i> For Sale
                                                </option>
                                            </select>
                                            @error('process_type')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status" class="form-label fw-bold">
                                                <i class="mdi mdi-checkbox-marked-circle text-warning me-1"></i>
                                                Status
                                            </label>
                                            <select name="status" id="status"
                                                class="form-select form-select-lg @error('status') is-invalid @enderror"
                                                required>
                                                <option value="">Select Status</option>
                                                <option value="available"
                                                    {{ old('status', $property->status) == 'available' ? 'selected' : '' }}>
                                                    <span class="badge bg-success">Available</span>
                                                </option>
                                                <option value="sold"
                                                    {{ old('status', $property->status) == 'sold' ? 'selected' : '' }}>
                                                    <span class="badge bg-danger">Sold</span>
                                                </option>
                                                <option value="pending"
                                                    {{ old('status', $property->status) == 'pending' ? 'selected' : '' }}>
                                                    <span class="badge bg-warning">Pending</span>
                                                </option>
                                                <option value="rented"
                                                    {{ old('status', $property->status) == 'rented' ? 'selected' : '' }}>
                                                    <span class="badge bg-info">Rented</span>
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Property Details Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="mdi mdi-details text-info me-2"></i>
                                    Property Details
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="year_built" class="form-label fw-bold">
                                                <i class="mdi mdi-calendar text-info me-1"></i>
                                                Year Built
                                            </label>
                                            <input type="number" name="year_built" id="year_built"
                                                class="form-control @error('year_built') is-invalid @enderror"
                                                value="{{ old('year_built', $property->year_built) }}" min="1800"
                                                max="{{ date('Y') + 5 }}" placeholder="2020">
                                            @error('year_built')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="bedrooms" class="form-label fw-bold">
                                                <i class="mdi mdi-bed text-primary me-1"></i>
                                                Bedrooms
                                            </label>
                                            <input type="number" name="bedrooms" id="bedrooms"
                                                class="form-control @error('bedrooms') is-invalid @enderror"
                                                value="{{ old('bedrooms', $property->bedrooms) }}" min="0"
                                                max="20" required placeholder="3">
                                            @error('bedrooms')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="bathrooms" class="form-label fw-bold">
                                                <i class="mdi mdi-shower text-info me-1"></i>
                                                Bathrooms
                                            </label>
                                            <input type="number" name="bathrooms" id="bathrooms"
                                                class="form-control @error('bathrooms') is-invalid @enderror"
                                                value="{{ old('bathrooms', $property->bathrooms) }}" min="0"
                                                max="20" required placeholder="2">
                                            @error('bathrooms')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="size" class="form-label fw-bold">
                                                <i class="mdi mdi-ruler text-warning me-1"></i>
                                                Size (sq ft)
                                            </label>
                                            <input type="number" name="size" id="size"
                                                class="form-control @error('size') is-invalid @enderror"
                                                value="{{ old('size', $property->size) }}" min="0" required
                                                placeholder="1500">
                                            @error('size')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="mdi mdi-map-marker text-danger me-2"></i>
                                    Location Information
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address" class="form-label fw-bold">
                                                <i class="mdi mdi-map-marker text-danger me-1"></i>
                                                Address
                                            </label>
                                            <input type="text" name="address" id="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                value="{{ old('address', $property->address) }}" required
                                                placeholder="Enter full address">
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="city" class="form-label fw-bold">
                                                <i class="mdi mdi-city text-primary me-1"></i>
                                                City
                                            </label>
                                            <input type="text" name="city" id="city"
                                                class="form-control @error('city') is-invalid @enderror"
                                                value="{{ old('city', $property->city) }}" required placeholder="City">
                                            @error('city')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="state" class="form-label fw-bold">
                                                <i class="mdi mdi-map text-info me-1"></i>
                                                State
                                            </label>
                                            <input type="text" name="state" id="state"
                                                class="form-control @error('state') is-invalid @enderror"
                                                value="{{ old('state', $property->state) }}" required
                                                placeholder="State">
                                            @error('state')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 mt-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="country" class="form-label fw-bold">
                                                <i class="mdi mdi-flag text-warning me-1"></i>
                                                Country
                                            </label>
                                            <input type="text" name="country" id="country"
                                                class="form-control @error('country') is-invalid @enderror"
                                                value="{{ old('country', $property->country) }}" required
                                                placeholder="Country">
                                            @error('country')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="zipcode" class="form-label fw-bold">
                                                <i class="mdi mdi-postal-lamp text-success me-1"></i>
                                                Zip Code
                                            </label>
                                            <input type="text" name="zipcode" id="zipcode"
                                                class="form-control @error('zipcode') is-invalid @enderror"
                                                value="{{ old('zipcode', $property->zipcode) }}" required
                                                placeholder="Zip Code">
                                            @error('zipcode')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Coordinates Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="mdi mdi-crosshairs-gps text-secondary me-2"></i>
                                    GPS Coordinates (Optional)
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="latitude" class="form-label fw-bold">
                                                <i class="mdi mdi-latitude text-info me-1"></i>
                                                Latitude
                                            </label>
                                            <input type="number" name="latitude" id="latitude"
                                                class="form-control @error('latitude') is-invalid @enderror"
                                                value="{{ old('latitude', $property->latitude) }}" step="any"
                                                min="-90" max="90" placeholder="40.7128">
                                            <div class="form-text">
                                                <i class="mdi mdi-information-outline me-1"></i>
                                                Between -90 and 90 degrees
                                            </div>
                                            @error('latitude')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="longitude" class="form-label fw-bold">
                                                <i class="mdi mdi-longitude text-warning me-1"></i>
                                                Longitude
                                            </label>
                                            <input type="number" name="longitude" id="longitude"
                                                class="form-control @error('longitude') is-invalid @enderror"
                                                value="{{ old('longitude', $property->longitude) }}" step="any"
                                                min="-180" max="180" placeholder="-74.0060">
                                            <div class="form-text">
                                                <i class="mdi mdi-information-outline me-1"></i>
                                                Between -180 and 180 degrees
                                            </div>
                                            @error('longitude')
                                                <div class="invalid-feedback">
                                                    <i class="mdi mdi-alert-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Current Images Section -->
                            @if ($property->images->count() > 0)
                                <div class="form-section mb-4">
                                    <h5 class="section-title">
                                        <i class="mdi mdi-image-multiple text-primary me-2"></i>
                                        Current Images
                                    </h5>
                                    <div class="row">
                                        @foreach ($property->images as $image)
                                            <div class="col-md-3 col-sm-4 col-6 mb-3">
                                                <div class="image-preview-item relative">
                                                    <img src="{{ $image->image_url }}" alt="Property Image"
                                                        class="img-fluid">
                                                    <a href="{{ route('auth.properties.deleteImage', $image->id) }}"
                                                        class="remove-image absolute top-1 right-1"
                                                        onclick="return confirm('Are you sure you want to delete this image?')"
                                                        title="Delete Image">
                                                        <i class="mdi mdi-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Add New Images Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="mdi mdi-image-plus text-success me-2"></i>
                                    Add New Images
                                </h5>
                                <div class="mb-3">
                                    <label for="images" class="form-label fw-bold">Select Images</label>
                                    <input type="file" name="images[]" id="images" class="form-control" multiple
                                        accept="image/*">
                                    <div id="simpleImagePreview" class="row mt-3"></div>
                                    <small class="text-muted">You can select up to 10 images. Each image must be less than
                                        5MB.</small>
                                </div>
                                @error('images')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="mdi mdi-alert-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('images.*')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="mdi mdi-alert-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Features Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="mdi mdi-star text-warning me-2"></i>
                                    Property Features
                                </h5>
                                <div class="features-grid">
                                    @foreach ($features as $feature)
                                        <div class="feature-item">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="features[]"
                                                    value="{{ $feature->id }}" id="feature{{ $feature->id }}"
                                                    {{ in_array($feature->id, old('features', $property->features->pluck('id')->toArray())) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="feature{{ $feature->id }}">
                                                    <i class="mdi mdi-check-circle text-success me-1"></i>
                                                    {{ $feature->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @error('features')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="mdi mdi-alert-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('features.*')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="mdi mdi-alert-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <button type="submit" class="btn btn-gradient-primary btn-lg me-3">
                                            <i class="mdi mdi-content-save me-2"></i>
                                            Update Property
                                        </button>
                                        <a href="{{ route('auth.properties.manage') }}" class="btn btn-light btn-lg">
                                            <i class="mdi mdi-arrow-left me-2"></i>
                                            Cancel
                                        </a>


                                    </div>
                                    <div class="form-progress">
                                        <div class="progress" style="width: 200px;">
                                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <small class="text-muted">Form completion</small>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('images');
            const previewContainer = document.getElementById('simpleImagePreview');
            if (!imageInput || !previewContainer) return;

            imageInput.addEventListener('change', function() {
                previewContainer.innerHTML = '';
                const files = Array.from(imageInput.files);
                if (files.length === 0) return;

                files.slice(0, 10).forEach(file => {
                    if (!file.type.startsWith('image/')) return;

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-md-3 col-6 mb-3';
                        col.innerHTML = `
                            <div class="border rounded p-2 text-center bg-light">
                                <img src="${e.target.result}" alt="Preview" class="img-fluid mb-2" style="max-height:120px;">
                                <div class="small text-truncate">${file.name}</div>
                            </div>
                        `;
                        previewContainer.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>
@endsection
