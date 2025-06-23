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
                Create New Property
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('auth.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('auth.properties.manage') }}">Properties</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Property</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card shadow-sm">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4 class="card-title mb-0">
                            <i class="mdi mdi-plus-circle me-2"></i>
                            Property Information
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('auth.properties.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

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
                                                   value="{{ old('title') }}" required
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
                                                    class="form-select form-select-lg @error('type') is-invalid @enderror" required>
                                                <option value="">Select Property Type</option>
                                                <option value="apartment" {{ old('type') == 'apartment' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-office-building"></i> Apartment
                                                </option>
                                                <option value="house" {{ old('type') == 'house' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-home"></i> House
                                                </option>
                                                <option value="villa" {{ old('type') == 'villa' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-home-variant"></i> Villa
                                                </option>
                                                <option value="cottage" {{ old('type') == 'cottage' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-home-modern"></i> Cottage
                                                </option>
                                                <option value="commercial" {{ old('type') == 'commercial' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-home-modern"></i> Commercial
                                                </option>
                                                <option value="land" {{ old('type') == 'land' ? 'selected' : '' }}>
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
                                    <textarea name="description" id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              rows="4" required
                                              placeholder="Describe your property in detail...">{{ old('description') }}</textarea>
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
                                                       value="{{ old('price') }}" min="0" step="0.01" required
                                                       placeholder="0.00">
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
                                                    class="form-select form-select-lg @error('process_type') is-invalid @enderror" required>
                                                <option value="">Select Type</option>
                                                <option value="1" {{ old('process_type') == '1' ? 'selected' : '' }}>
                                                    <i class="mdi mdi-key"></i> For Rent
                                                </option>
                                                <option value="0" {{ old('process_type') == '0' ? 'selected' : '' }}>
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
                                                    class="form-select form-select-lg @error('status') is-invalid @enderror" required>
                                                <option value="">Select Status</option>
                                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                                                    <span class="badge bg-success">Available</span>
                                                </option>
                                                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>
                                                    <span class="badge bg-danger">Sold</span>
                                                </option>
                                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                                    <span class="badge bg-warning">Pending</span>
                                                </option>
                                                <option value="rented" {{ old('status') == 'rented' ? 'selected' : '' }}>
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
                                                   value="{{ old('year_built') }}" min="1800" max="{{ date('Y') + 5 }}"
                                                   placeholder="2020">
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
                                                   value="{{ old('bedrooms') }}" min="0" max="20" required
                                                   placeholder="3">
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
                                                   value="{{ old('bathrooms') }}" min="0" max="20" required
                                                   placeholder="2">
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
                                                   value="{{ old('size') }}" min="0" required
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
                                                   value="{{ old('address') }}" required
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
                                                   value="{{ old('city') }}" required
                                                   placeholder="City">
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
                                                   value="{{ old('state') }}" required
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
                                                   value="{{ old('country') }}" required
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
                                                   value="{{ old('zipcode') }}" required
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
                                                   value="{{ old('latitude') }}" step="any" min="-90" max="90"
                                                   placeholder="40.7128">
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
                                                   value="{{ old('longitude') }}" step="any" min="-180" max="180"
                                                   placeholder="-74.0060">
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

                            <!-- Images Section -->
                            <div class="form-section mb-4">
                                <h5 class="section-title">
                                    <i class="mdi mdi-image-multiple text-primary me-2"></i>
                                    Property Images
                                </h5>
                                <div class="image-upload-container @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror">
                                    <div class="image-upload-area" id="imageUploadArea">
                                        <div class="upload-placeholder">
                                            <i class="mdi mdi-cloud-upload" style="font-size: 64px; color: #6c757d;"></i>
                                            <h6 class="mt-3 mb-2">Drag & Drop Images Here</h6>
                                            <p class="text-muted mb-2">or click to browse files</p>
                                            <div class="upload-info">
                                                <span class="badge bg-primary me-2">JPG, PNG, GIF</span>
                                                <span class="badge bg-info me-2">Max 5MB each</span>
                                                <span class="badge bg-success">Up to 10 images</span>
                                            </div>
                                        </div>
                                        <input type="file" name="images[]" id="images" class="form-control" multiple accept="image/*" style="display: none;">
                                    </div>
                                    <div class="image-preview-container mt-4" id="imagePreviewContainer" style="display: none;">
                                        <h6 class="preview-title">
                                            <i class="mdi mdi-image-multiple text-primary me-2"></i>
                                            Selected Images
                                        </h6>
                                        <div class="row" id="imagePreviewRow">
                                            <!-- Image previews will be inserted here -->
                                        </div>
                                    </div>
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
                                                       {{ in_array($feature->id, old('features', [])) ? 'checked' : '' }}>
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
                                            Create Property
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
    <script src="{{ asset('assets/admin/js/property-forms.js') }}"></script>
@endsection
