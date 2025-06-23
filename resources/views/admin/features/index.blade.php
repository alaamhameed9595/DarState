@extends('layouts.admin')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-star"></i>
                    </span>
                    Property Features
                </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('auth.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Features</li>
                    </ol>
                </nav>
            </div>

            <div class="row">
                <div class="col-lg-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title">All Features</h4>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addFeatureModal">
                                    <i class="mdi mdi-plus"></i> Add Feature
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered" id="features_table" style="width: 100%">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Feature Name</th>
                                            <th>Properties Count</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features as $feature)
                                            <tr>
                                                <td>{{ $feature->id }}</td>
                                                <td>
                                                    <span class="feature-name">{{ $feature->name }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info">{{ $feature->properties->count() }}</span>
                                                </td>
                                                <td>{{ $feature->created_at->format('M d, Y H:i') }}</td>
                                                <td>{{ $feature->updated_at->format('M d, Y H:i') }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm edit-feature"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editFeatureModal"
                                                            data-id="{{ $feature->id }}"
                                                            data-name="{{ $feature->name }}"
                                                            title="Edit feature">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <form action="{{ route('auth.features.destroy', $feature->id) }}"
                                                          method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this feature?')"
                                                                title="Delete feature">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                @if ($features)
                                    {{ $features->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Feature Modal -->
    <div class="modal fade" id="addFeatureModal" tabindex="-1" aria-labelledby="addFeatureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFeatureModalLabel">Add New Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('auth.features.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="feature_name">Feature Name</label>
                            <input type="text" class="form-control" id="feature_name" name="name" required
                                   placeholder="Enter feature name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Feature</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Feature Modal -->
    <div class="modal fade" id="editFeatureModal" tabindex="-1" aria-labelledby="editFeatureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFeatureModalLabel">Edit Feature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editFeatureForm" method="POST" >
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_feature_name">Feature Name</label>
                            <input type="text" class="form-control" id="edit_feature_name" name="name" required
                                   placeholder="Enter feature name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Feature</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#features_table').DataTable({
                "searching": true,
                "ordering": true,
                "responsive": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "language": {
                    "search": "Search features:",
                    "lengthMenu": "Show _MENU_ entries per page",
                    "zeroRecords": "No matching features found",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No features available",
                    "infoFiltered": "(filtered from _MAX_ total features)"
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

            // Handle edit feature modal
            $('.edit-feature').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#edit_feature_name').val(name);
                $('#editFeatureForm').attr('action', '/features/' + id);
            });

            // Show success/error messages
            @if(session('success'))
                alert('{{ session('success') }}');
            @endif

            @if(session('error'))
                alert('{{ session('error') }}');
            @endif
        });
    </script>
@endsection
