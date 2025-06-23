@extends('layouts.admin')

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
            <div class="row">
                <div class="col-lg-12 grid-margin ">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('auth.properties.create') }}" class="btn btn-primary btn-sm">Create
                                Property</a>
                            <h4 class="card-title">All properties</h4>


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
                                            <th>Size</th>
                                            <th>Year Built</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($properties as $property)
                                            <tr>
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
                                                        class="btn btn-info btn-sm" title="view property"><i
                                                            class="fa fa-eye"></i></a>
                                                    @haspermission('edit properties')
                                                        <a href="{{ route('auth.properties.edit', $property->id) }}"
                                                            class="btn btn-warning btn-sm" title="edit property"><i
                                                                class="fa fa-edit"></i></a>
                                                    @endhaspermission
                                                    @haspermission('delete properties')
                                                        <form action="{{ route('auth.properties.destroy', $property->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                                    class="fa fa-trash"></i></button>
                                                        </form>
                                                    @endhaspermission
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                @if ($properties)
                                    {{ $properties->links() }}
                                @endif
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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#property_table').DataTable({
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    "language": {
                        "search": "Search properties:",
                        "lengthMenu": "Show _MENU_ entries per page",
                        "zeroRecords": "No matching properties found",
                        "info": "Showing page _PAGE_ of _PAGES_",
                        "infoEmpty": "No properties available",
                        "infoFiltered": "(filtered from _MAX_ total properties)"
                    },
                    "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "initComplete": function() {
                        // Add custom class to search input
                        $('.dataTables_filter input').addClass('form-control');
                        $('.dataTables_length select').addClass('form-control');
                    }
                });
            });
        </script>
    @endsection
