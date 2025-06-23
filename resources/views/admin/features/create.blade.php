@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-star"></i>
                </span>
                Create New Feature
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('auth.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('auth.features.index') }}">Features</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Feature</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('auth.features.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Feature Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}" required placeholder="Enter feature name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Enter a descriptive name for the property feature (e.g., Swimming Pool, Garden, Parking)</small>
                            </div>

                            <div class="form-group">
                                <label for="description">Description (Optional)</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                          rows="3" placeholder="Enter feature description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Provide additional details about this feature</small>
                            </div>

                            <div class="form-group">
                                <label for="icon">Icon (Optional)</label>
                                <input type="text" name="icon" id="icon" class="form-control @error('icon') is-invalid @enderror"
                                       value="{{ old('icon') }}" placeholder="mdi mdi-pool">
                                @error('icon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Enter Material Design Icon class (e.g., mdi mdi-pool for swimming pool)</small>
                            </div>

                            <div class="form-group">
                                <label for="category">Category (Optional)</label>
                                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    <option value="amenity" {{ old('category') == 'amenity' ? 'selected' : '' }}>Amenity</option>
                                    <option value="facility" {{ old('category') == 'facility' ? 'selected' : '' }}>Facility</option>
                                    <option value="service" {{ old('category') == 'service' ? 'selected' : '' }}>Service</option>
                                    <option value="security" {{ old('category') == 'security' ? 'selected' : '' }}>Security</option>
                                    <option value="entertainment" {{ old('category') == 'entertainment' ? 'selected' : '' }}>Entertainment</option>
                                    <option value="outdoor" {{ old('category') == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                                    <option value="indoor" {{ old('category') == 'indoor' ? 'selected' : '' }}>Indoor</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Categorize the feature for better organization</small>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                                           value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active Feature
                                    </label>
                                </div>
                                <small class="form-text text-muted">Inactive features won't appear in property creation forms</small>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">
                                <i class="mdi mdi-content-save"></i> Create Feature
                            </button>
                            <a href="{{ route('auth.features.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-generate icon suggestion based on feature name
            const nameInput = document.getElementById('name');
            const iconInput = document.getElementById('icon');

            nameInput.addEventListener('input', function() {
                const name = this.value.toLowerCase();
                let iconSuggestion = '';

                // Common icon mappings
                const iconMap = {
                    'pool': 'mdi mdi-pool',
                    'garden': 'mdi mdi-flower',
                    'parking': 'mdi mdi-car',
                    'gym': 'mdi mdi-dumbbell',
                    'elevator': 'mdi mdi-elevator',
                    'balcony': 'mdi mdi-view-dashboard',
                    'fireplace': 'mdi mdi-fire',
                    'air conditioning': 'mdi mdi-air-conditioner',
                    'heating': 'mdi mdi-radiator',
                    'wifi': 'mdi mdi-wifi',
                    'security': 'mdi mdi-shield',
                    'camera': 'mdi mdi-camera',
                    'doorman': 'mdi mdi-account',
                    'storage': 'mdi mdi-package-variant',
                    'laundry': 'mdi mdi-washing-machine',
                    'dishwasher': 'mdi mdi-dishwasher',
                    'furnished': 'mdi mdi-sofa',
                    'pet friendly': 'mdi mdi-paw',
                    'smoking': 'mdi mdi-smoking',
                    'non-smoking': 'mdi mdi-smoking-off'
                };

                // Check for matches
                for (const [key, icon] of Object.entries(iconMap)) {
                    if (name.includes(key)) {
                        iconSuggestion = icon;
                        break;
                    }
                }

                // Only suggest if icon field is empty
                if (iconInput.value === '' && iconSuggestion !== '') {
                    iconInput.placeholder = iconSuggestion;
                }
            });
        });
    </script>
@endsection
