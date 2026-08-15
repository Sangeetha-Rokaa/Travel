@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('topbar-extras')
    <div
        class="flex items-center gap-2 bg-white border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-600 cursor-pointer hover:border-blue-400 transition">
        <i class="far fa-calendar-alt text-slate-400"></i>
        <span
            id="dateRangeLabel">{{ $dateRangeLabel ?? now()->subDays(30)->format('M d') . ' – ' . now()->format('M d, Y') }}</span>
        <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
    </div>
@endsection

@section('content')

    {{-- ===================== STAT CARDS ===================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

        {{-- Total Bookings --}}
        <div class="stat-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-slate-500 text-sm font-medium mb-1">Total Bookings</p>
                    <h2 class="text-3xl font-bold text-slate-800">{{ number_format($totalBookings ?? 0) }}</h2>
                </div>
                <div class="stat-icon" style="background:#eff6ff;">
                    <i class="far fa-clock text-blue-500"></i>
                </div>
            </div>
            <p class="text-xs font-semibold" style="color:{{ ($bookingsGrowth ?? 0) >= 0 ? '#16a34a' : '#dc2626' }};">
                <i class="fas fa-arrow-{{ ($bookingsGrowth ?? 0) >= 0 ? 'up' : 'down' }} mr-1"></i>
                {{ abs($bookingsGrowth ?? 0) }}%
                <span class="text-slate-400 font-normal">from last month</span>
            </p>
        </div>

        {{-- Total Revenue --}}
        <div class="stat-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-slate-500 text-sm font-medium mb-1">Total Revenue</p>
                    <h2 class="text-3xl font-bold text-slate-800">${{ number_format($totalRevenue ?? 0) }}</h2>
                </div>
                <div class="stat-icon" style="background:#fffbeb;">
                    <i class="fas fa-briefcase text-amber-500"></i>
                </div>
            </div>
            <p class="text-xs font-semibold" style="color:{{ ($revenueGrowth ?? 0) >= 0 ? '#16a34a' : '#dc2626' }};">
                <i class="fas fa-arrow-{{ ($revenueGrowth ?? 0) >= 0 ? 'up' : 'down' }} mr-1"></i>
                {{ abs($revenueGrowth ?? 0) }}%
                <span class="text-slate-400 font-normal">from last month</span>
            </p>
        </div>

        {{-- Total Users --}}
        <div class="stat-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-slate-500 text-sm font-medium mb-1">Total Users</p>
                    <h2 class="text-3xl font-bold text-slate-800">{{ number_format($totalUsers ?? 0) }}</h2>
                </div>
                <div class="stat-icon" style="background:#f0f9ff;">
                    <i class="far fa-user text-sky-500"></i>
                </div>
            </div>
            <p class="text-xs font-semibold" style="color:{{ ($usersGrowth ?? 0) >= 0 ? '#16a34a' : '#dc2626' }};">
                <i class="fas fa-arrow-{{ ($usersGrowth ?? 0) >= 0 ? 'up' : 'down' }} mr-1"></i>
                {{ abs($usersGrowth ?? 0) }}%
                <span class="text-slate-400 font-normal">from last month</span>
            </p>
        </div>

        {{-- Total Enquiries --}}
        <div class="stat-card">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-slate-500 text-sm font-medium mb-1">Total Enquiries</p>
                    <h2 class="text-3xl font-bold text-slate-800">{{ number_format($totalEnquiries ?? 0) }}</h2>
                </div>
                <div class="stat-icon" style="background:#f0fdf4;">
                    <i class="far fa-comment-dots text-green-500"></i>
                </div>
            </div>
            <p class="text-xs font-semibold" style="color:{{ ($enquiriesGrowth ?? 0) >= 0 ? '#16a34a' : '#dc2626' }};">
                <i class="fas fa-arrow-{{ ($enquiriesGrowth ?? 0) >= 0 ? 'up' : 'down' }} mr-1"></i>
                {{ abs($enquiriesGrowth ?? 0) }}%
                <span class="text-slate-400 font-normal">from last month</span>
            </p>
        </div>

    </div>

    {{-- ===================== CHARTS ROW 1 ===================== --}}
    <div class="grid grid-cols-1 xl:grid-cols-5 gap-5 mb-6">

        {{-- Bookings Overview (line chart) --}}
        <div class="chart-card xl:col-span-3">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-slate-800 font-bold text-base">Bookings Overview</h3>
                <div class="flex items-center gap-4 text-xs font-medium text-slate-500">
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span> Bookings
                    </span>
                    <span class="flex items-center gap-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-violet-400 inline-block"></span> Revenue
                    </span>
                </div>
            </div>
            <div style="height:220px; position:relative;">
                <canvas id="bookingsOverviewChart"></canvas>
            </div>
        </div>

        {{-- Bookings by Status (donut chart) --}}
        <div class="chart-card xl:col-span-2">
            <h3 class="text-slate-800 font-bold text-base mb-5">Bookings by Status</h3>
            <div class="flex items-center justify-between gap-4">
                <div style="position:relative; width:160px; height:160px; flex-shrink:0;">
                    <canvas id="bookingStatusChart"></canvas>
                    <div
                        style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;pointer-events:none;">
                        <div class="text-2xl font-bold text-slate-800 leading-tight">
                            {{ number_format($totalBookings ?? 0) }}</div>
                        <div class="text-xs text-slate-400 font-medium">Total</div>
                    </div>
                </div>
                <div class="flex flex-col gap-3 flex-1">
                    @php
                        $total = $totalBookings > 0 ? $totalBookings : 1;
                        $statusBreakdown = $bookingsByStatus ?? [];
                        $confirmed = $statusBreakdown['confirmed'] ?? 0;
                        $pending = $statusBreakdown['pending'] ?? 0;
                        $cancelled = $statusBreakdown['cancelled'] ?? 0;
                        $completed = $statusBreakdown['completed'] ?? 0;
                    @endphp
                    <div class="flex items-center justify-between gap-2">
                        <span class="flex items-center gap-1.5 text-xs text-slate-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block flex-shrink-0"></span> Confirmed
                        </span>
                        <span class="text-xs font-semibold text-slate-700">
                            {{ number_format($confirmed) }} ({{ round(($confirmed / $total) * 100) }}%)
                        </span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="flex items-center gap-1.5 text-xs text-slate-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block flex-shrink-0"></span> Pending
                        </span>
                        <span class="text-xs font-semibold text-slate-700">
                            {{ number_format($pending) }} ({{ round(($pending / $total) * 100) }}%)
                        </span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="flex items-center gap-1.5 text-xs text-slate-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block flex-shrink-0"></span> Cancelled
                        </span>
                        <span class="text-xs font-semibold text-slate-700">
                            {{ number_format($cancelled) }} ({{ round(($cancelled / $total) * 100) }}%)
                        </span>
                    </div>
                    <div class="flex items-center justify-between gap-2">
                        <span class="flex items-center gap-1.5 text-xs text-slate-600">
                            <span class="w-2.5 h-2.5 rounded-full bg-teal-400 inline-block flex-shrink-0"></span> Completed
                        </span>
                        <span class="text-xs font-semibold text-slate-700">
                            {{ number_format($completed) }} ({{ round(($completed / $total) * 100) }}%)
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===================== CHARTS ROW 2 ===================== --}}
    <div class="grid grid-cols-1 xl:grid-cols-5 gap-5">

        {{-- Top Destinations --}}
        <div class="chart-card xl:col-span-2">
            <h3 class="text-slate-800 font-bold text-base mb-5">Top Destinations</h3>
            <div class="flex flex-col gap-4">
                @php
                    $topDestinations = $topDestinations ?? [];
                    $maxBookings = $topDestinations->max('bookings_count') ?: 1;
                @endphp
                @forelse($topDestinations as $dest)
                    @php
                        $pct = round(($dest->bookings_count / $maxBookings) * 100);
                    @endphp
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-sm text-slate-700 font-medium">{{ $dest->name }}</span>
                            <span
                                class="text-sm font-semibold text-slate-600">{{ number_format($dest->bookings_count) }}</span>
                        </div>
                        <div class="progress-bar-bg">
                            <div class="progress-bar-fill" style="width:{{ $pct }}%;"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">No destination data available.</p>
                @endforelse
            </div>
        </div>

        {{-- Revenue Overview (area chart) --}}
        <div class="chart-card xl:col-span-2">
            <h3 class="text-slate-800 font-bold text-base mb-5">Revenue Overview</h3>
            <div style="height:200px; position:relative;">
                <canvas id="revenueOverviewChart"></canvas>
            </div>
        </div>

        {{-- Recent Bookings --}}
        <div class="chart-card xl:col-span-1" style="min-width:0;">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-800 font-bold text-base">Recent Bookings</h3>
            </div>

            <div>
                @forelse($recentBookings ?? [] as $booking)
                    @php
                        $initials = collect(explode(' ', $booking->user?->name ?? ($booking->customer_name ?? 'NA')))
                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                            ->take(2)
                            ->implode('');
                    @endphp
                    <div class="booking-row">
                        <div class="avatar">{{ $initials }}</div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-700 leading-tight truncate">
                                {{ $booking->user?->name ?? ($booking->customer_name ?? 'Unknown') }}
                            </p>
                            <p class="text-xs text-slate-400 truncate mt-0.5">
                                {{ $booking->package?->name ?? ($booking->trek?->name ?? ($booking->tour_name ?? '—')) }}
                            </p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-xs text-slate-400 mb-1">
                                {{ \Carbon\Carbon::parse($booking->created_at)->format('M j, Y') }}
                            </p>
                            <div class="flex items-center gap-1.5 justify-end">
                                <span class="text-xs font-semibold text-slate-700">
                                    ${{ number_format($booking->total_price ?? ($booking->amount ?? 0)) }}
                                </span>
                                <span class="badge badge-{{ strtolower($booking->status) }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 py-4 text-center">No recent bookings.</p>
                @endforelse
            </div>

            <div class="mt-4 pt-2 border-t border-slate-100 text-right">
                <a href="{{ route('admin.bookings.index') }}"
                    class="text-sm font-semibold text-blue-500 hover:text-blue-700 transition">
                    View All Bookings <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ─── Data from controller (passed as JSON) ────────────────────────
            const chartLabels = @json($chartLabels ?? []);
            const bookingsData = @json($bookingsChartData ?? []);
            const revenueData = @json($revenueChartData ?? []);

            const statusConfirmed = {{ $bookingsByStatus['confirmed'] ?? 0 }};
            const statusPending = {{ $bookingsByStatus['pending'] ?? 0 }};
            const statusCancelled = {{ $bookingsByStatus['cancelled'] ?? 0 }};
            const statusCompleted = {{ $bookingsByStatus['completed'] ?? 0 }};

            // ─── Bookings Overview (dual line) ───────────────────────────────
            const ctxBookings = document.getElementById('bookingsOverviewChart').getContext('2d');
            const bookingGrad = ctxBookings.createLinearGradient(0, 0, 0, 220);
            bookingGrad.addColorStop(0, 'rgba(59,130,246,0.18)');
            bookingGrad.addColorStop(1, 'rgba(59,130,246,0.01)');

            const revenueGrad = ctxBookings.createLinearGradient(0, 0, 0, 220);
            revenueGrad.addColorStop(0, 'rgba(139,92,246,0.13)');
            revenueGrad.addColorStop(1, 'rgba(139,92,246,0.01)');

            new Chart(ctxBookings, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                            label: 'Bookings',
                            data: bookingsData,
                            borderColor: '#3b82f6',
                            backgroundColor: bookingGrad,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 0,
                            pointHoverRadius: 5,
                            borderWidth: 2.5,
                        },
                        {
                            label: 'Revenue',
                            data: revenueData,
                            borderColor: '#a78bfa',
                            backgroundColor: revenueGrad,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 0,
                            pointHoverRadius: 5,
                            borderWidth: 2.5,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    size: 11
                                },
                                maxRotation: 0,
                                callback(val, i) {
                                    return i % 2 === 0 ? this.getLabelForValue(val) : '';
                                }
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            min: 0,
                            grid: {
                                color: '#f1f5f9',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    size: 11
                                },
                                stepSize: 20
                            },
                            border: {
                                display: false
                            }
                        }
                    }
                }
            });

            // ─── Bookings by Status (doughnut) ───────────────────────────────
            const ctxStatus = document.getElementById('bookingStatusChart').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Confirmed', 'Pending', 'Cancelled', 'Completed'],
                    datasets: [{
                        data: [statusConfirmed, statusPending, statusCancelled, statusCompleted],
                        backgroundColor: ['#3b82f6', '#fbbf24', '#f87171', '#34d399'],
                        borderWidth: 0,
                        hoverOffset: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '72%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label(ctx) {
                                    return ` ${ctx.label}: ${ctx.parsed}`;
                                }
                            }
                        }
                    }
                }
            });

            // ─── Revenue Overview (area chart) ───────────────────────────────
            const ctxRevenue = document.getElementById('revenueOverviewChart').getContext('2d');
            const revGrad = ctxRevenue.createLinearGradient(0, 0, 0, 200);
            revGrad.addColorStop(0, 'rgba(59,130,246,0.20)');
            revGrad.addColorStop(1, 'rgba(59,130,246,0.02)');

            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Revenue ($)',
                        data: revenueData,
                        borderColor: '#3b82f6',
                        backgroundColor: revGrad,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 0,
                        pointHoverRadius: 5,
                        borderWidth: 2.5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    size: 10
                                },
                                maxRotation: 0,
                                callback(val, i) {
                                    return i % 3 === 0 ? this.getLabelForValue(val) : '';
                                }
                            },
                            border: {
                                display: false
                            }
                        },
                        y: {
                            min: 0,
                            grid: {
                                color: '#f1f5f9'
                            },
                            ticks: {
                                color: '#94a3b8',
                                font: {
                                    size: 10
                                },
                                callback(v) {
                                    return '$' + (v / 1000).toFixed(0) + 'K';
                                }
                            },
                            border: {
                                display: false
                            }
                        }
                    }
                }
            });

        });
    </script>
@endpush
