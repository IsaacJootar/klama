@php
    use Carbon\Carbon;
    use App\Models\HouseLaundryRequest;
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white border-0 shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-white mb-1 fw-semibold">Housekeeping Dashboard</h3>
                            <p class="mb-0 opacity-75">{{ Carbon::today()->timezone('Africa/Lagos')->format('l, F j, Y') }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="me-3">
                                    <small class="d-block opacity-75">Clean Rooms</small>
                                    <h4 class="text-white mb-0">{{ $clean_rooms ?? 'N/A' }}</h4>
                                </div>
                                <div class="avatar avatar-lg">
                                    <span class="avatar-initial rounded-circle bg-white text-primary">
                                        <i class="ti ti-checks ti-lg"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Primary Metrics Row -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-primary">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="text-white mb-1">Clean Rooms</h5>
                            <h3 class="mb-0">{{ $clean_rooms ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-primary">
                                <i class="ti ti-checks ti-sm"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block opacity-75">Available rooms</small>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ ($clean_rooms / ($clean_rooms + $dirty_rooms + $under_maintenance_rooms ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-danger">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="text-white mb-1">Dirty Rooms</h5>
                            <h3 class="mb-0">{{ $dirty_rooms ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-danger">
                                <i class="ti ti-x ti-sm"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block opacity-75">Rooms to clean</small>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ ($dirty_rooms / ($clean_rooms + $dirty_rooms + $under_maintenance_rooms ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-info">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="text-white mb-1">Pending Laundry</h5>
                            <h3 class="mb-0">{{ $pending_laundry_requests ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-info">
                                <i class="ti ti-basket ti-sm"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block opacity-75">Laundry requests</small>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ ($pending_laundry_requests / ($pending_laundry_requests + HouseLaundryRequest::where('status', 'Delivered')->count() ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-success">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="text-white mb-1">Active Tasks</h5>
                            <h3 class="mb-0">{{ $active_tasks ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-success">
                                <i class="ti ti-list-check ti-sm"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block opacity-75">Ongoing tasks</small>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ ($active_tasks / ($active_tasks + $completed_tasks_today ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Metrics Row -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-primary">
                            <i class="ti ti-calendar ti-lg text-white"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $scheduled_cleanings_today ?? 'N/A' }}</h4>
                    <small class="text-muted">Cleanings Today</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-success">
                            <i class="ti ti-check-square ti-lg text-white"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $completed_tasks_today ?? 'N/A' }}</h4>
                    <small class="text-muted">Tasks Completed</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-danger">
                            <i class="ti ti-tool ti-lg text-white"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $under_maintenance_rooms ?? 'N/A' }}</h4>
                    <small class="text-muted">Under Maintenance</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial rounded-circle bg-info">
                            <i class="ti ti-users ti-lg text-white"></i>
                        </span>
                    </div>
                    <h4 class="mb-1">{{ $assigned_staff ?? 'N/A' }}</h4>
                    <small class="text-muted">Assigned Staff</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Cleaning Trends (Last 7 Days)</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Last 7 Days
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                            <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="cleaningTrendsChart" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Laundry Request Trends (Last 7 Days)</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Last 7 Days
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                            <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="laundryTrendsChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Performance Metrics Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Housekeeping Performance</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card h-100 gradient-card-primary">
                                <div class="card-body text-white">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h5 class="text-white mb-1">Clean Rooms</h5>
                                            <h4 class="mb-0">{{ $clean_rooms ?? 0 }}</h4>
                                        </div>
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-initial rounded-circle bg-white text-primary">
                                                <i class="ti ti-checks ti-sm"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="d-block opacity-75">Available rooms</small>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar bg-white" style="width: {{ ($clean_rooms / ($clean_rooms + $dirty_rooms + $under_maintenance_rooms ?: 1)) * 100 }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card h-100 gradient-card-success">
                                <div class="card-body text-white">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h5 class="text-white mb-1">Active Tasks</h5>
                                            <h4 class="mb-0">{{ $active_tasks ?? 0 }}</h4>
                                        </div>
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-initial rounded-circle bg-white text-success">
                                                <i class="ti ti-list-check ti-sm"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="d-block opacity-75">Ongoing tasks</small>
                                    <div class="d-flex align-items-center text-white mt-2">
                                        <i class="ti ti-chevron-up ti-xs me-1"></i>
                                        <small>{{ $active_tasks ? round(($active_tasks / ($active_tasks + $completed_tasks_today ?: 1)) * 100, 1) : 0 }}%</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card h-100 gradient-card-info">
                                <div class="card-body text-white">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h5 class="text-white mb-1">Pending Laundry</h5>
                                            <h4 class="mb-0">{{ $pending_laundry_requests ?? 0 }}</h4>
                                        </div>
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-initial rounded-circle bg-white text-info">
                                                <i class="ti ti-basket ti-sm"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="d-block opacity-75">Laundry requests</small>
                                    <div class="d-flex align-items-center text-white mt-2">
                                        <i class="ti ti-chevron-up ti-xs me-1"></i>
                                        <small>{{ $pending_laundry_requests ? round(($pending_laundry_requests / ($pending_laundry_requests + HouseLaundryRequest::where('status', 'Delivered')->count() ?: 1)) * 100, 1) : 0 }}%</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Vuexy-inspired Design -->
    <style>
        :root {
            --primary: #696cff;
            --success: #71dd37;
            --info: #03c3ec;
            --danger: #ff3e1d;
            --teal: #20c997;
            --pink: #e83e8c;
            --indigo: #6610f2;
            --cyan: #17c0eb;
            --body-bg: #f5f5f9;
            --body-color: #697a8d;
            --heading-color: #566a7f;
            --primary-gradient: linear-gradient(135deg, #696cff 0%, #7873f5 100%);
            --success-gradient: linear-gradient(135deg, #71dd37 0%, #28c76f 100%);
            --info-gradient: linear-gradient(135deg, #03c3ec 0%, #00b8d9 100%);
            --danger-gradient: linear-gradient(135deg, #ff3e1d 0%, #ff5733 100%);
            --teal-gradient: linear-gradient(135deg, #20c997 0%, #17a2b8 100%);
            --pink-gradient: linear-gradient(135deg, #e83e8c 0%, #ff6b6b 100%);
            --indigo-gradient: linear-gradient(135deg, #6610f2 0%, #6f42c1 100%);
            --cyan-gradient: linear-gradient(135deg, #17c0eb 0%, #00b7eb 100%);
        }

        body {
            background: var(--body-bg);
            color: var(--body-color);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .card {
            border: none;
            border-radius: 0.625rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.2s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .gradient-card-primary {
            background: var(--primary-gradient);
            border: none;
        }

        .gradient-card-success {
            background: var(--success-gradient);
            border: none;
        }

        .gradient-card-info {
            background: var(--info-gradient);
            border: none;
        }

        .gradient-card-danger {
            background: var(--danger-gradient);
            border: none;
        }

        .gradient-card-teal {
            background: var(--teal-gradient);
            border: none;
        }

        .gradient-card-pink {
            background: var(--pink-gradient);
            border: none;
        }

        .gradient-card-indigo {
            background: var(--indigo-gradient);
            border: none;
        }

        .gradient-card-cyan {
            background: var(--cyan-gradient);
            border: none;
        }

        .card-header {
            background: transparent;
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .card-title {
            color: var(--heading-color);
            font-size: 1.125rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .progress {
            background-color: rgba(105, 108, 255, 0.16);
            border-radius: 0.25rem;
            height: 4px;
        }

        .progress-bar {
            border-radius: 0.25rem;
        }

        .text-muted {
            color: var(--body-color);
            opacity: 0.7;
        }

        .dropdown-toggle {
            background: transparent;
            border-color: rgba(0, 0, 0, 0.1);
            color: var(--body-color);
        }

        .dropdown-menu {
            border-radius: 0.375rem;
            box-shadow: 0 0.25rem 1rem rgba(0, 0, 0, 0.1);
        }

        /* Animations */
        .card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            transform: translateY(1rem);
        }

        .card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-title {
                font-size: 1rem;
            }

            .card-body {
                padding: 1rem;
            }

            .avatar-lg {
                width: 2.5rem;
                height: 2.5rem;
            }

            .avatar-sm {
                width: 1.5rem;
                height: 1.5rem;
            }
        }
    </style>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Cleaning Trends Chart
        const cleaningTrendsCtx = document.getElementById('cleaningTrendsChart').getContext('2d');
        const cleaningTrendsData = @json($cleaning_trends ?? []);
        new Chart(cleaningTrendsCtx, {
            type: 'line',
            data: {
                labels: cleaningTrendsData.map(item => item.date),
                datasets: [{
                    label: 'Cleanings',
                    data: cleaningTrendsData.map(item => item.cleanings),
                    borderColor: '#696cff',
                    backgroundColor: 'rgba(105, 108, 255, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#696cff',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#697a8d'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cleanings',
                            color: '#697a8d'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            color: '#697a8d'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#697a8d'
                        }
                    }
                }
            }
        });

        // Laundry Trends Chart
        const laundryTrendsCtx = document.getElementById('laundryTrendsChart').getContext('2d');
        const laundryTrendsData = @json($laundry_trends ?? []);
        new Chart(laundryTrendsCtx, {
            type: 'bar',
            data: {
                labels: laundryTrendsData.map(item => item.date),
                datasets: [{
                    label: 'Laundry Requests',
                    data: laundryTrendsData.map(item => item.requests),
                    backgroundColor: 'rgba(105, 108, 255, 0.8)',
                    borderColor: '#696cff',
                    borderWidth: 1,
                    borderRadius: 4,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#697a8d'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Requests',
                            color: '#697a8d'
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            color: '#697a8d'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#697a8d'
                        }
                    }
                }
            }
        });
    });
  
    
    </script>
    
</div>