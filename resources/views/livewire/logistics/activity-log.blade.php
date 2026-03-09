<div>
    
    
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Main Content -->
        <div class="col-xl-9 col-lg-8 col-md-12">
            <!-- Header Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card bg-primary text-white border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h3 class="text-white mb-1 fw-semibold">Logistics Activity Dashboard</h3>
                                    <p class="mb-0 opacity-75">{{ \Carbon\Carbon::today()->timezone('Africa/Lagos')->format('l, F j, Y') }}</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <div class="me-3">
                                            <small class="d-block opacity-75">Total Reports</small>
                                            <h4 class="text-white mb-0">{{ $total_reports ?? 0 }}</h4>
                                        </div>
                                        <div class="avatar avatar-lg">
                                            <span class="avatar-initial rounded-circle bg-white text-primary">
                                                <i class="ti ti-report ti-lg"></i>
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
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100 gradient-card-primary">
                        <div class="card-body text-white">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="text-white mb-1">Total Reports</h5>
                                    <h3 class="mb-0">{{ $total_reports ?? 0 }}</h3>
                                </div>
                                <div class="avatar avatar-sm">
                                    <span class="avatar-initial rounded-circle bg-white text-primary">
                                        <i class="ti ti-report ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <small class="d-block opacity-75">All logistics reports</small>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-white" style="width: {{ (($total_reports ?? 0) / (($total_reports ?? 1) ?: 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100 gradient-card-success">
                        <div class="card-body text-white">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="text-white mb-1">Fleet Items</h5>
                                    <h3 class="mb-0">{{ $total_fleet_items ?? 0 }}</h3>
                                </div>
                                <div class="avatar avatar-sm">
                                    <span class="avatar-initial rounded-circle bg-white text-success">
                                        <i class="ti ti-truck ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <small class="d-block opacity-75">Total vehicles/assets</small>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-white" style="width: {{ (($total_fleet_items ?? 0) / (($total_fleet_items ?? 1) ?: 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100 gradient-card-info">
                        <div class="card-body text-white">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="text-white mb-1">Trips Made</h5>
                                    <h3 class="mb-0">{{ $total_trips_made ?? 0 }}</h3>
                                </div>
                                <div class="avatar avatar-sm">
                                    <span class="avatar-initial rounded-circle bg-white text-info">
                                        <i class="ti ti-road ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <small class="d-block opacity-75">Total trips recorded</small>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-white" style="width: {{ (($total_trips_made ?? 0) / (($total_trips_made ?? 1) ?: 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="card h-100 gradient-card-danger">
                        <div class="card-body text-white">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h5 class="text-white mb-1">Breakdowns</h5>
                                    <h3 class="mb-0">{{ $total_breakdowns ?? 0 }}</h3>
                                </div>
                                <div class="avatar avatar-sm">
                                    <span class="avatar-initial rounded-circle bg-white text-danger">
                                        <i class="ti ti-alert-triangle ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <small class="d-block opacity-75">Total breakdowns reported</small>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-white" style="width: {{ (($total_breakdowns ?? 0) / (($total_breakdowns ?? 1) ?: 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trips Trends Chart -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Trips Made Trends (Last 7 Days)</h5>
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
                            <canvas id="tripsTrendsChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="col-xl-3 col-lg-4 col-md-12">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Additional Metrics</h5>
                </div>
                <div class="card-body">
                    <!-- Airport Pickups -->
                    <div class="mb-4">
                        <div class="card gradient-card-info">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="text-white mb-1">Airport Pickups</h5>
                                        <h3 class="mb-0">{{ $total_airport_pickups ?? 0 }}</h3>
                                    </div>
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial rounded-circle bg-white text-info">
                                            <i class="ti ti-plane ti-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <small class="d-block opacity-75">Total pickups reported</small>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: {{ (($total_airport_pickups ?? 0) / (($total_airport_pickups ?? 1) ?: 1)) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fleet Categories -->
                    <div class="mb-4">
                        <div class="card gradient-card-primary">
                            <div class="card-body text-white">
                                <h5 class="text-white mb-3">Fleet Categories</h5>
                                @foreach (($fleet_categories ?? []) as $category => $count)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span>{{ $category }}</span>
                                        <span class="badge bg-white text-primary">{{ $count }}</span>
                                    </div>
                                @endforeach
                                @if (empty($fleet_categories))
                                    <p class="text-white opacity-75 mb-0">No fleet categories available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logistics Management Action -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card h-100 gradient-card-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="text-white mb-1">Manage Logistics</h5>
                            <p class="text-white opacity-75 mb-2">View reports or manage fleet items</p>
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
            --body-bg: #f5f5f9;
            --body-color: #697a8d;
            --heading-color: #566a7f;
            --primary-gradient: linear-gradient(135deg, #696cff 0%, #7873f5 100%);
            --success-gradient: linear-gradient(135deg, #71dd37 0%, #28c76f 100%);
            --info-gradient: linear-gradient(135deg, #03c3ec 0%, #00b8d9 100%);
            --danger-gradient: linear-gradient(135deg, #ff3e1d 0%, #ff5733 100%);
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

        /* Responsive Sidebar */
        @media (max-width: 1199px) {
            .col-xl-3 {
                margin-top: 1.5rem;
            }
        }

        @media (max-width: 767px) {
            .col-xl-3 {
                display: none;
            }
            .sidebar-toggle {
                display: block !important;
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
            }
        }

        .sidebar-toggle {
            display: none;
        }
    </style>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Trips Trends Chart
        const tripsTrendsCtx = document.getElementById('tripsTrendsChart').getContext('2d');
        const tripsTrendsData = @json($trips_trends ?? []);
        new Chart(tripsTrendsCtx, {
            type: 'line',
            data: {
                labels: tripsTrendsData.map(item => item.date),
                datasets: [{
                    label: 'Trips Made',
                    data: tripsTrendsData.map(item => item.trips),
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
                            text: 'Trips Count',
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

    <!-- Sidebar Toggle Script for Mobile -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.createElement('button');
        sidebarToggle.className = 'btn btn-primary sidebar-toggle rounded-circle';
        sidebarToggle.innerHTML = '<i class="ti ti-menu-2"></i>';
        sidebarToggle.setAttribute('data-bs-toggle', 'offcanvas');
        sidebarToggle.setAttribute('data-bs-target', '#sidebarOffcanvas');
        document.body.appendChild(sidebarToggle);

        const sidebar = document.querySelector('.col-xl-3');
        const offcanvas = document.createElement('div');
        offcanvas.className = 'offcanvas offcanvas-end';
        offcanvas.id = 'sidebarOffcanvas';
        offcanvas.setAttribute('tabindex', '-1');
        offcanvas.innerHTML = `
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Additional Metrics</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                ${sidebar.innerHTML}
            </div>
        `;
        document.body.appendChild(offcanvas);
    });
    </script>
</div>

</div>