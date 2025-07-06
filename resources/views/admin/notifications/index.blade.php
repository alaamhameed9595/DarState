@extends('layouts.admin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-bell"></i>
                </span>
                Notifications
            </h3>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title">All Notifications</h4>
                            <div>
                                <button class="btn btn-success btn-sm" id="markAllRead">
                                    <i class="mdi mdi-check-all"></i> Mark All as Read
                                </button>
                                <a href="{{ route('auth.dashboard') }}" class="btn btn-secondary btn-sm">
                                    <i class="mdi mdi-arrow-left"></i> Back to Dashboard
                                </a>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($notifications->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover notification-table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Type</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($notifications as $notification)
                                            <tr class="{{ $notification->read_at ? '' : 'table-light' }}">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($notification->data['type'] ?? '' === 'property_inquiry')
                                                            <div class="preview-icon bg-info me-2">
                                                                <i class="mdi mdi-home"></i>
                                                            </div>
                                                            <span class="badge bg-info">Property Inquiry</span>
                                                        @elseif($notification->data['type'] ?? '' === 'contact_form')
                                                            <div class="preview-icon bg-warning me-2">
                                                                <i class="mdi mdi-email"></i>
                                                            </div>
                                                            <span class="badge bg-warning">Contact Form</span>
                                                        @else
                                                            <div class="preview-icon bg-secondary me-2">
                                                                <i class="mdi mdi-bell"></i>
                                                            </div>
                                                            <span class="badge bg-secondary">General</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <h6 class="mb-1">{{ $notification->data['title'] ?? 'Notification' }}</h6>
                                                        <p class="text-muted mb-0">{{ $notification->data['message'] ?? 'No message available' }}</p>
                                                        @if(isset($notification->data['data']))
                                                            <small class="text-muted">
                                                                @if(isset($notification->data['data']['name']))
                                                                    From: {{ $notification->data['data']['name'] }}
                                                                @endif
                                                                @if(isset($notification->data['data']['email']))
                                                                    ({{ $notification->data['data']['email'] }})
                                                                @endif
                                                            </small>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if($notification->read_at)
                                                        <span class="badge bg-success">Read</span>
                                                    @else
                                                        <span class="badge bg-danger">Unread</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        @if(!$notification->read_at)
                                                            <button class="btn btn-sm btn-outline-success mark-read"
                                                                    data-id="{{ $notification->id }}"
                                                                    title="Mark as Read">
                                                                <i class="mdi mdi-check"></i>
                                                            </button>
                                                        @endif
                                                        <button class="btn btn-sm btn-outline-danger delete-notification"
                                                                data-id="{{ $notification->id }}"
                                                                title="Delete">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $notifications->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="mdi mdi-bell-off text-muted" style="font-size: 4rem;"></i>
                                <h4 class="text-muted mt-3">No notifications found</h4>
                                <p class="text-muted">You're all caught up! No new notifications at the moment.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .notification-table {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .notification-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .notification-table thead th {
        border: none;
        padding: 15px 12px;
        font-weight: 600;
    }

    .notification-table tbody tr {
        transition: all 0.3s ease;
    }

    .notification-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .preview-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
    }

    .btn-group .btn {
        margin: 0 2px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-group .btn:hover {
        transform: scale(1.05);
    }

    .mark-read {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        color: white;
    }

    .delete-notification {
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        border: none;
        color: white;
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Mark single notification as read
    $('.mark-read').click(function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        $.post(`/notifications/${id}/mark-read`, {
            _token: '{{ csrf_token() }}'
        })
        .done(function(response) {
            if (response.success) {
                row.removeClass('table-light');
                row.find('.badge.bg-danger').removeClass('bg-danger').addClass('bg-success').text('Read');
                $(this).remove();
                updateNotificationCount();
            }
        })
        .fail(function() {
            alert('Error marking notification as read');
        });
    });

    // Mark all notifications as read
    $('#markAllRead').click(function() {
        $.post('/notifications/mark-all-read', {
            _token: '{{ csrf_token() }}'
        })
        .done(function(response) {
            if (response.success) {
                location.reload();
            }
        })
        .fail(function() {
            alert('Error marking all notifications as read');
        });
    });

    // Delete notification
    $('.delete-notification').click(function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');

        if (confirm('Are you sure you want to delete this notification?')) {
            $.ajax({
                url: `/notifications/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                }
            })
            .done(function(response) {
                if (response.success) {
                    row.fadeOut();
                    updateNotificationCount();
                }
            })
            .fail(function() {
                alert('Error deleting notification');
            });
        }
    });

    // Update notification count in header
    function updateNotificationCount() {
        $.get('/notifications/unread-count')
        .done(function(response) {
            var count = response.count;
            var countElement = $('.count-symbol.bg-danger');

            if (count > 0) {
                countElement.text(count);
                countElement.show();
            } else {
                countElement.hide();
            }
        });
    }

    // Auto-refresh notification count every 30 seconds
    setInterval(updateNotificationCount, 30000);
});
</script>
@endsection
