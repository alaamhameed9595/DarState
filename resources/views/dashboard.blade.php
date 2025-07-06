@extends('layouts.admin')
    @section('content')
        <style>
            .hover-bg-light:hover {
                background-color: #f8f9fa !important;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .card-title a:hover {
                color: #007bff !important;
                transition: color 0.3s ease;
            }

            .stretch-card a:hover .card {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.15);
                transition: all 0.3s ease;
            }

                    .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

                /* Chart container styling */
        .chart-container {
            position: relative;
            height: 300px !important;
            width: 100% !important;
            overflow: hidden;
        }

        .chart-container canvas {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            max-height: 100% !important;
            max-width: 100% !important;
        }

        .card-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        /* Chart hover effects */
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        /* Prevent chart overflow */
        .card-body {
            overflow: hidden;
        }
        </style>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span> Dashboard
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i
                                    class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                @haspermission('view analytics')
                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-md-4 stretch-card grid-margin">
                            <a href="{{ route('auth.properties.manage') }}" class="text-decoration-none">
                                <div class="card bg-gradient-danger card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                            alt="circle-image" />
                                        <h4 class="font-weight-normal mb-3">Total Properties <i
                                                class="mdi mdi-home mdi-24px float-end"></i>
                                        </h4>
                                        <h2 class="mb-5">{{ number_format($totalProperties) }}</h2>
                                        <h6 class="card-text">{{ $propertiesThisMonth }} added this month</h6>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4 stretch-card grid-margin">
                            <a href="{{ route('auth.users.index') }}" class="text-decoration-none">
                                <div class="card bg-gradient-success card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                            alt="circle-image" />
                                        <h4 class="font-weight-normal mb-3">Total Users<i class="mdi mdi-account-group mdi-24px float-end"></i>
                                        </h4>
                                        <h2 class="mb-5">{{ number_format($totalUsers) }}</h2>
                                        <h6 class="card-text">Registered users</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <a href="{{ route('auth.properties.manage') }}" class="text-decoration-none">
                                <div class="card bg-gradient-warning card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                            alt="circle-image" />
                                        <h4 class="font-weight-normal mb-3">Avg. Price<i class="mdi mdi-currency-usd mdi-24px float-end"></i>
                                        </h4>
                                        <h2 class="mb-5">AED {{ number_format($avgPrice) }}</h2>
                                        <h6 class="card-text">Average property price</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Price Range Cards -->
                    <div class="row">
                        <div class="col-md-4 stretch-card grid-margin">
                            <a href="{{ route('auth.properties.manage') }}" class="text-decoration-none">
                                <div class="card bg-gradient-primary card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                            alt="circle-image" />
                                        <h4 class="font-weight-normal mb-3">Highest Price<i class="mdi mdi-trending-up mdi-24px float-end"></i>
                                        </h4>
                                        <h2 class="mb-5">AED {{ number_format($maxPrice) }}</h2>
                                        <h6 class="card-text">Most expensive property</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4 stretch-card grid-margin">
                            <a href="{{ route('auth.properties.manage') }}" class="text-decoration-none">
                                <div class="card bg-gradient-secondary card-img-holder text-white">
                                    <div class="card-body">
                                        <img src="{{ asset('assets/admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                            alt="circle-image" />
                                        <h4 class="font-weight-normal mb-3">Lowest Price<i class="mdi mdi-trending-down mdi-24px float-end"></i>
                                        </h4>
                                        <h2 class="mb-5">AED {{ number_format($minPrice) }}</h2>
                                        <h6 class="card-text">Most affordable property</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Property Types and Recent Activity -->
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="{{ route('auth.properties.manage') }}" class="text-decoration-none text-dark">
                                            Properties by Type <i class="mdi mdi-arrow-right"></i>
                                        </a>
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Count</th>
                                                    <th>Percentage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($propertiesByType as $type)
                                                <tr>
                                                    <td>{{ $type->type }}</td>
                                                    <td>{{ $type->count }}</td>
                                                    <td>{{ number_format(($type->count / $totalProperties) * 100, 1) }}%</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="{{ route('auth.properties.manage') }}" class="text-decoration-none text-dark">
                                            Top Performing Properties <i class="mdi mdi-arrow-right"></i>
                                        </a>
                                    </h4>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Property</th>
                                                    <th>Type</th>
                                                    <th>Inquiries</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($topProperties as $property)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('auth.properties.show', $property->id) }}" class="text-decoration-none">
                                                            {{ Str::limit($property->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $property->type }}</td>
                                                    <td><span class="badge badge-success">{{ $property->inquiries_count }}</span></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="{{ route('auth.properties.manage') }}" class="text-decoration-none text-dark">
                                            Recent Properties <i class="mdi mdi-arrow-right"></i>
                                        </a>
                                    </h4>
                                    <div class="list-wrapper">
                                        @foreach($recentProperties as $property)
                                        <a href="{{ route('auth.properties.show', $property->id) }}" class="text-decoration-none">
                                            <div class="d-flex justify-content-between border-bottom py-3 hover-bg-light">
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-home text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="mb-1 text-dark">{{ $property->title }}</h6>
                                                        <small class="text-muted">{{ $property->type }} - AED {{ number_format($property->price) }}</small>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <small class="text-muted">{{ $property->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="{{ route('auth.inquiries.index') }}" class="text-decoration-none text-dark">
                                            Recent Inquiries <i class="mdi mdi-arrow-right"></i>
                                        </a>
                                    </h4>
                                    <div class="list-wrapper">
                                        @foreach($recentInquiries as $inquiry)
                                            <div class="d-flex justify-content-between border-bottom py-3 hover-bg-light">
                                                <div class="d-flex align-items-center">
                                                    <i class="mdi mdi-message-text text-info me-3"></i>
                                                    <div>
                                                        <h6 class="mb-1 text-dark">{{ $inquiry->name }}</h6>
                                                        <small class="text-muted">{{ $inquiry->email }} - {{ $inquiry->phone }}</small>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <small class="text-muted">{{ $inquiry->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="row">
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Property Trends (Last 6 Months)</h4>
                                    <div class="chart-container" style="position: relative; height: 300px;">
                                        <canvas id="propertyTrendsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Property Types Distribution</h4>
                                    <div class="chart-container" style="position: relative; height: 300px;">
                                        <canvas id="propertyTypesChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Inquiry Trends (Last 6 Months)</h4>
                                    <div class="chart-container" style="position: relative; height: 300px;">
                                        <canvas id="inquiryTrendsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Price Range Distribution</h4>
                                    <div class="chart-container" style="position: relative; height: 300px;">
                                        <canvas id="priceRangeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhaspermission

            </div>

            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Property Trends Chart (Line Chart)
        const propertyTrendsCtx = document.getElementById('propertyTrendsChart').getContext('2d');
        const propertyTrendsChart = new Chart(propertyTrendsCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($monthlyData)) !!},
                datasets: [{
                    label: 'Properties Added',
                    data: {!! json_encode(array_column($monthlyData, 'properties')) !!},
                    borderColor: '#4CAF50',
                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#4CAF50',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }, {
                    label: 'Inquiries Received',
                    data: {!! json_encode(array_column($monthlyData, 'inquiries')) !!},
                    borderColor: '#2196F3',
                    backgroundColor: 'rgba(33, 150, 243, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#2196F3',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 11,
                                weight: 'bold'
                            }
                        }
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#666'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#666'
                        }
                    }
                },
                elements: {
                    point: {
                        hoverBackgroundColor: '#fff'
                    }
                }
            }
        });

        // Property Types Distribution (Doughnut Chart)
        const propertyTypesCtx = document.getElementById('propertyTypesChart').getContext('2d');
        const propertyTypesChart = new Chart(propertyTypesCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($propertyTypeData)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($propertyTypeData)) !!},
                    backgroundColor: [
                        '#FF6B6B',
                        '#4ECDC4',
                        '#45B7D1',
                        '#96CEB4',
                        '#FFEAA7',
                        '#DDA0DD'
                    ],
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverBorderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 10,
                            font: {
                                size: 10,
                                weight: '500'
                            }
                        }
                    },
                    title: {
                        display: false
                    }
                },
                cutout: '60%'
            }
        });

        // Inquiry Trends Chart (Bar Chart)
        const inquiryTrendsCtx = document.getElementById('inquiryTrendsChart').getContext('2d');
        const inquiryTrendsChart = new Chart(inquiryTrendsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($monthlyData)) !!},
                datasets: [{
                    label: 'Inquiries',
                    data: {!! json_encode(array_column($monthlyData, 'inquiries')) !!},
                    backgroundColor: 'rgba(156, 39, 176, 0.8)',
                    borderColor: '#9C27B0',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#666'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#666'
                        }
                    }
                }
            }
        });

        // Price Range Distribution (Bar Chart)
        const priceRangeCtx = document.getElementById('priceRangeChart').getContext('2d');
        const priceRangeChart = new Chart(priceRangeCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($priceRanges)) !!},
                datasets: [{
                    label: 'Properties',
                    data: {!! json_encode(array_values($priceRanges)) !!},
                    backgroundColor: [
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(33, 150, 243, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(244, 67, 54, 0.8)',
                        'rgba(156, 39, 176, 0.8)'
                    ],
                    borderColor: [
                        '#4CAF50',
                        '#2196F3',
                        '#FFC107',
                        '#F44336',
                        '#9C27B0'
                    ],
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#666'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#666'
                        }
                    }
                }
            }
        });
    </script>
     @endsection
