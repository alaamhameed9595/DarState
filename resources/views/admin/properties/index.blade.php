@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@latest/ol.css">
    <style>
        #map {
            width: 100%;
            height: 600px;
        }

        .ol-popup {
            position: absolute;
            background-color: white;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            bottom: 12px;
            left: -50px;
            min-width: 200px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
        }

        .ol-popup:after,
        .ol-popup:before {
            top: 100%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .ol-popup:after {
            border-top-color: white;
            border-width: 10px;
            left: 48px;
            margin-left: -10px;
        }

        .ol-popup-closer {
            text-decoration: none;
            position: absolute;
            top: 2px;
            right: 8px;
        }

        /* Unify placeholder font for all form controls */
        input.form-control::placeholder,
        select.form-select {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 0.9rem;
            color: #888;
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
            padding: 0;
            list-style: none;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination .page-link {
            color: #007bff;
            background: #fff;
            border: 1px solid #dee2e6;
            padding: 0.375rem 0.75rem;
            margin-left: -1px;
            text-decoration: none;
            border-radius: 0.25rem;
            transition: background 0.2s, color 0.2s;
        }

        .pagination .page-item.active .page-link {
            background: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination .page-link:hover {
            background: #e9ecef;
            color: #0056b3;
        }

        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            background: #fff;
            border-color: #dee2e6;
        }
    </style>
@endsection
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">All properties</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('auth.properties.manage') }}">properties</a></li>
                    </ol>
                </nav>
            </div>
            @php
                $payload = urlencode(
                    json_encode(
                        $properties instanceof \Illuminate\Pagination\LengthAwarePaginator
                            ? $properties->items()
                            : $properties,
                    ),
                );
            @endphp
            <div class="row">
                <div class="col-lg-12 grid-margin ">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <a href="{{ route('auth.properties.create') }}" class="btn btn-primary btn-sm">Create
                                Property</a>
                            <a href="#" id="send-filtered"
                                class="btn btn-outline-info btn-sm d-flex align-items-center" title="Show in Map"
                                style="gap: 6px;">
                                <i class="fa fa-map"></i>
                                Show in Map
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">All properties</h4>
                            <form method="GET" action="{{ route('auth.properties.manage') }}" class="mb-3"
                                id="property-search-form">
                                <div class="row g-2 align-items-end mb-2">
                                    <div class="col-md-3">
                                        <input type="text" name="q" id="property-search" class="form-control"
                                            placeholder="Search properties..." value="{{ request('q') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="price_min" class="form-control" placeholder="Min Price"
                                            value="{{ request('price_min') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="price_max" class="form-control" placeholder="Max Price"
                                            value="{{ request('price_max') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="area" class="form-control" placeholder="Area (m²)"
                                            value="{{ request('area') }}">
                                    </div>

                                </div>
                                <div class="row g-2 align-items-end mb-2">
                                    <div class="col-md-3">
                                        <select name="status" id="property-status" class="form-select">
                                            <option value="">All Statuses</option>
                                            <option value="available" @if (request('status') == 'available') selected @endif>
                                                Available</option>
                                            <option value="rented" @if (request('status') == 'rented') selected @endif>Rented
                                            </option>
                                            <option value="sold" @if (request('status') == 'sold') selected @endif>Sold
                                            </option>
                                            <option value="pending" @if (request('status') == 'pending') selected @endif>
                                                Pending</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="city" id="property-city" class="form-select">
                                            <option value="">All Cities</option>
                                            @foreach ($cities ?? [] as $city)
                                                <option value="{{ $city }}"
                                                    @if (request('city') == $city) selected @endif>{{ $city }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="country" id="property-country" class="form-select">
                                            <option value="">All Countries</option>
                                            @foreach ($countries ?? [] as $country)
                                                <option value="{{ $country }}"
                                                    @if (request('country') == $country) selected @endif>{{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select name="type" id="property-type" class="form-select">
                                            <option value="">All Types</option>
                                            <option value="apartment" @if (request('type') == 'apartment') selected @endif>
                                                Apartment
                                            </option>
                                            <option value="house" @if (request('type') == 'house') selected @endif>House
                                            </option>
                                            <option value="land" @if (request('type') == 'land') selected @endif>Land
                                            </option>
                                            <option value="commercial" @if (request('type') == 'commercial') selected @endif>
                                                Commercial</option>
                                            <option value="villa" @if (request('type') == 'villa') selected @endif>Villa
                                            </option>
                                            <option value="cottage" @if (request('type') == 'cottage') selected @endif>
                                                Cottage</option>
                                        </select>
                                    </div>


                                </div>
                                <div class="row g-2 align-items-end mb-2">
                                    <div class="col-md-6">
                                        <input type="number" name="bedrooms" class="form-control" placeholder="Bedrooms"
                                            value="{{ request('bedrooms') }}">
                                    </div>
                                    <div class="col-md-6 d-flex gap-2">
                                        <input type="number" name="bathrooms" class="form-control" placeholder="Bathrooms"
                                            value="{{ request('bathrooms') }}">
                                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <div id="property-table-container">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered" id="property_table"
                                        style="width: 100%">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Title</th>
                                                <th>Rent/Sale</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Country</th>
                                                <th>Price</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Bedrooms</th>
                                                <th>Bathrooms</th>
                                                <th>Area</th>
                                                <th>Year Built</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($properties as $property)
                                                <tr data-longitude="{{ $property->longitude }}"
                                                    data-latitude="{{ $property->latitude }}">
                                                    <td><a
                                                            href="{{ route('auth.properties.show', $property->id) }}">{{ $property->title }}</a>
                                                    </td>
                                                    <td>{{ $property->process_type ? 'Rent' : 'Sale' }}</td>
                                                    <td>{{ $property->city }}</td>
                                                    <td>{{ $property->state }}</td>
                                                    <td>{{ $property->country }}</td>
                                                    <td>{{ $property->price }}</td>
                                                    <td>{{ $property->type }}</td>
                                                    <td>{{ $property->status }}</td>
                                                    <td>{{ $property->bedrooms }}</td>
                                                    <td>{{ $property->bathrooms }}</td>
                                                    <td>{{ $property->size }}</td>
                                                    <td>{{ $property->year_built }}</td>
                                                    <td>
                                                        <a href="{{ route('auth.properties.show', $property->id) }}"
                                                            class="btn btn-primary btn-sm" title="view property"><i
                                                                class="fa fa-eye"></i></a>
                                                        @haspermission('edit properties')
                                                            <a href="{{ route('auth.properties.edit', $property->id) }}"
                                                                class="btn btn-warning btn-sm" title="edit property"><i
                                                                    class="fa fa-edit"></i></a>
                                                        @endhaspermission
                                                        @haspermission('delete properties')
                                                            <form
                                                                action="{{ route('auth.properties.destroy', $property->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                                        class="fa fa-trash"></i></button>
                                                            </form>
                                                        @endhaspermission
                                                        @if (!$property->is_published)
                                                            @haspermission('publish properties')
                                                                <a href="{{ route('auth.properties.publish', $property->id) }}"
                                                                    class="btn btn-info btn-sm" title="publish property"><i
                                                                        class="fa fa-globe"></i></a>
                                                            @endhaspermission
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    @if ($properties)
                                        <div class="pagination-wrapper">
                                            {{ $properties->links('pagination::bootstrap-4') }}
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- content-wrapper ends -->
    @endsection
    <!-- partial -->
    <!-- main-panel ends -->
    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('property-search-form');
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(form);
                    const params = new URLSearchParams(formData).toString();
                    fetch(window.location.pathname + '?' + params, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newTable = doc.querySelector('#property-table-container');
                            document.getElementById('property-table-container').innerHTML = newTable
                                .innerHTML;
                            // Update the Show in Map button payload after filtering
                            updateMapPayloadFromTable();
                        });
                });
                // Also update payload on page load
                updateMapPayloadFromTable();
                // Show in Map button click
                const sendFilteredBtn = document.getElementById('send-filtered');
                if (sendFilteredBtn) {
                    sendFilteredBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        // Always recalculate payload before opening
                        const propertiesData = [];
                        document.querySelectorAll('#property_table tbody tr').forEach(row => {
                            const tds = row.querySelectorAll('td');
                            if (tds.length) {
                                propertiesData.push({
                                    id: tds[0].querySelector('a')?.href.split('/').pop(),
                                    title: tds[0].innerText.trim(),
                                    process_type: tds[1].innerText.trim(),
                                    city: tds[2].innerText.trim(),
                                    state: tds[3].innerText.trim(),
                                    country: tds[4].innerText.trim(),
                                    price: tds[5].innerText.trim(),
                                    type: tds[6].innerText.trim(),
                                    status: tds[7].innerText.trim(),
                                    bedrooms: tds[8].innerText.trim(),
                                    bathrooms: tds[9].innerText.trim(),
                                    size: tds[10].innerText.trim(),
                                    year_built: tds[11].innerText.trim(),
                                    longitude: row.getAttribute('data-longitude'),
                                    latitude: row.getAttribute('data-latitude')
                                });
                            }
                        });
                        const payload = encodeURIComponent(JSON.stringify(propertiesData));
                        window.open(`/properties/map?payload=${payload}`, '_blank');
                    });
                }

                function updateMapPayloadFromTable() {
                    // This function is now only for legacy href update, not used for opening
                }
            });
        </script>
    @endsection
