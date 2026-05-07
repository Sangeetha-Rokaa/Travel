{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Nepal Travel Dashboard')
@section('page_title', 'Admin Dashboard')
@section('page_icon', 'fas fa-chart-line')

@section('content')
    {{-- Stats Cards with Icons and Progress --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card-box bg-trek position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1 opacity-75"><i class="fas fa-person-hiking me-1"></i> Treks</h5>
                        <h2 class="mb-0 fw-bold display-6">{{ $treksCount ?? 0 }}</h2>
                        <small class="opacity-75">Active Expeditions</small>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="fas fa-mountain fa-2x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ $treksActivePercentage ?? 75 }}%"></div>
                    </div>
                    <small class="opacity-75">{{ $treksActiveCount ?? 9 }} Active / {{ $treksInactiveCount ?? 3 }}
                        Inactive</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card-box bg-destination position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1 opacity-75"><i class="fas fa-map-marked-alt me-1"></i> Destinations</h5>
                        <h2 class="mb-0 fw-bold display-6">{{ $destinationsCount ?? 0 }}</h2>
                        <small class="opacity-75">Beautiful Places</small>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="fas fa-globe-asia fa-2x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ $destinationsActivePercentage ?? 85 }}%"></div>
                    </div>
                    <small class="opacity-75">{{ $destinationsActiveCount ?? 7 }} Active /
                        {{ $destinationsInactiveCount ?? 1 }} Inactive</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card-box bg-package position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1 opacity-75"><i class="fas fa-suitcase-rolling me-1"></i> Packages</h5>
                        <h2 class="mb-0 fw-bold display-6">{{ $packagesCount ?? 0 }}</h2>
                        <small class="opacity-75">Travel Itineraries</small>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="fas fa-ticket-alt fa-2x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ $packagesActivePercentage ?? 100 }}%"></div>
                    </div>
                    <small class="opacity-75">{{ $packagesActiveCount ?? 5 }} Active / {{ $packagesInactiveCount ?? 0 }}
                        Inactive</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card-box bg-contact position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1 opacity-75"><i class="fas fa-id-card me-1"></i> Inquiries</h5>
                        <h2 class="mb-0 fw-bold display-6">{{ $inquiriesCount ?? 0 }}</h2>
                        <small class="opacity-75">Customer Messages</small>
                    </div>
                    <div class="bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="fas fa-envelope fa-2x"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="progress bg-white bg-opacity-25" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ $inquiriesUnreadPercentage ?? 30 }}%"></div>
                    </div>
                    <small class="opacity-75">{{ $unreadInquiries ?? 7 }} Unread / {{ $readInquiries ?? 16 }} Read</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts and Analytics Row --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-chart-line me-2" style="color: #e9b35f;"></i>
                        Monthly Overview
                    </h5>
                    <select class="form-select form-select-sm w-auto" id="chartYear" style="border-radius: 30px;">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
                <canvas id="monthlyChart" height="250"></canvas>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="bg-white rounded-4 shadow-sm p-4 h-100">
                <h5 class="mb-4 fw-semibold">
                    <i class="fas fa-chart-pie me-2" style="color: #e9b35f;"></i>
                    Trek Distribution by Region
                </h5>
                <canvas id="regionChart" height="200"></canvas>
                <div class="mt-3" id="regionLegend"></div>
            </div>
        </div>
    </div>

    {{-- Recent Activity and Quick Actions Row --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="bg-white rounded-4 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-semibold">
                        <i class="fas fa-history me-2" style="color: #e9b35f;"></i>
                        Recent Activities
                    </h5>
                    <a href="#" class="text-decoration-none small" style="color: #e9b35f;">View All</a>
                </div>
                <div class="timeline">
                    @forelse($recentActivities ?? [] as $activity)
                        <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle p-2"
                                    style="background: {{ $activity['color'] ?? '#e9b35f' }}20;">
                                    <i class="{{ $activity['icon'] ?? 'fas fa-bell' }}"
                                        style="color: {{ $activity['color'] ?? '#e9b35f' }};"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-0 fw-semibold">{{ $activity['title'] ?? '' }}</p>
                                <small class="text-muted">{{ $activity['description'] ?? '' }}</small>
                                <div>
                                    <small class="text-muted">{{ $activity['time'] ?? '' }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-2"></i>
                            <p class="text-muted">No recent activities</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="row g-4">
                {{-- Quick Actions --}}
                <div class="col-12">
                    <div class="bg-white rounded-4 shadow-sm p-4">
                        <h5 class="mb-3 fw-semibold">
                            <i class="fas fa-bolt me-2" style="color: #e9b35f;"></i>
                            Quick Actions
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="{{ route('admin.treks.create') }}" class="text-decoration-none">
                                    <div class="text-center p-3 rounded-3"
                                        style="background: #fef9e6; transition: all 0.3s;">
                                        <i class="fas fa-plus-circle fa-2x mb-2" style="color: #0ea5e9;"></i>
                                        <p class="mb-0 small fw-semibold">Add Trek</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.destinations.create') }}" class="text-decoration-none">
                                    <div class="text-center p-3 rounded-3"
                                        style="background: #fef9e6; transition: all 0.3s;">
                                        <i class="fas fa-map-marker-alt fa-2x mb-2" style="color: #10b981;"></i>
                                        <p class="mb-0 small fw-semibold">Add Destination</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.packages.create') }}" class="text-decoration-none">
                                    <div class="text-center p-3 rounded-3"
                                        style="background: #fef9e6; transition: all 0.3s;">
                                        <i class="fas fa-box fa-2x mb-2" style="color: #f59e0b;"></i>
                                        <p class="mb-0 small fw-semibold">Add Package</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Inquiries Preview --}}
                <div class="col-12">
                    <div class="bg-white rounded-4 shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-semibold">
                                <i class="fas fa-envelope me-2" style="color: #e9b35f;"></i>
                                Recent Inquiries
                            </h5>
                            <a href="{{ route('admin.contacts.index') }}" class="text-decoration-none small"
                                style="color: #e9b35f;">View All</a>
                        </div>
                        @forelse($recentInquiries ?? [] as $inquiry)
                            <div class="d-flex gap-3 mb-3 pb-3 border-bottom align-items-start">
                                <div class="flex-shrink-0">
                                    <div class="rounded-circle bg-warning bg-opacity-10 p-2">
                                        <i class="fas fa-user" style="color: #e9b35f;"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0 fw-semibold">{{ $inquiry['name'] ?? '' }}</p>
                                        <small class="text-muted">{{ $inquiry['time'] ?? '' }}</small>
                                    </div>
                                    <small class="text-muted d-block">{{ $inquiry['subject'] ?? '' }}</small>
                                    <small class="text-muted">{{ Str::limit($inquiry['message'] ?? '', 80) }}</small>
                                </div>
                                @if (($inquiry['is_read'] ?? false) == false)
                                    <span class="badge" style="background: #ef4444; border-radius: 30px;">New</span>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-2"></i>
                                <p class="text-muted">No inquiries yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Welcome Section with System Info --}}
    <div class="row">
        <div class="col-12">
            <div class="bg-gradient rounded-4 shadow-sm p-4 text-white"
                style="background: linear-gradient(135deg, #1e2a2e, #2c4a3e);">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h4 class="mb-2">
                            <i class="fas fa-hand-peace me-2"></i>
                            Welcome back, {{ Auth::user()->name ?? 'Admin' }}!
                        </h4>
                        <p class="mb-0 opacity-75">
                            <i class="fas fa-chart-simple me-1"></i>
                            System is running smoothly.
                            <strong>{{ $todayBookings ?? 0 }}</strong> bookings today,
                            <strong>{{ $activeUsers ?? 0 }}</strong> active users.
                        </p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-light" style="border-radius: 40px; color: #1e2a2e;">
                            <i class="fas fa-file-alt me-2"></i> Generate Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card-box {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .progress {
            border-radius: 10px;
        }

        .quick-action-btn {
            transition: all 0.3s ease;
        }

        .quick-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .timeline {
            max-height: 350px;
            overflow-y: auto;
        }

        .timeline::-webkit-scrollbar {
            width: 4px;
        }

        .timeline::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .timeline::-webkit-scrollbar-thumb {
            background: #e9b35f;
            border-radius: 10px;
        }

        .bg-gradient {
            background: linear-gradient(135deg, #1e2a2e, #2c4a3e);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-box,
        .bg-white {
            animation: fadeInUp 0.5s ease-out;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Chart
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Treks Added',
                    data: {{ json_encode($monthlyTreksData ?? [5, 7, 8, 6, 10, 12, 9, 11, 15, 18, 20, 22]) }},
                    borderColor: '#0ea5e9',
                    backgroundColor: 'rgba(14, 165, 233, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Inquiries',
                    data: {{ json_encode($monthlyInquiriesData ?? [12, 15, 18, 22, 25, 30, 28, 32, 35, 40, 45, 50]) }},
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0e2ce'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Region Distribution Chart
        const regionCtx = document.getElementById('regionChart').getContext('2d');
        const regionChart = new Chart(regionCtx, {
            type: 'doughnut',
            data: {
                labels: {{ json_encode($regionLabels ?? ['Himalayas', 'Hills', 'Terai', 'Kathmandu Valley']) }},
                datasets: [{
                    data: {{ json_encode($regionData ?? [45, 30, 10, 15]) }},
                    backgroundColor: ['#0ea5e9', '#10b981', '#f59e0b', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Chart Year Change Handler
        document.getElementById('chartYear')?.addEventListener('change', function() {
            // Fetch new data based on year
            fetch(`/admin/dashboard/chart-data?year=${this.value}`)
                .then(response => response.json())
                .then(data => {
                    monthlyChart.data.datasets[0].data = data.treks;
                    monthlyChart.data.datasets[1].data = data.inquiries;
                    monthlyChart.update();
                });
        });
    </script>
@endpush
