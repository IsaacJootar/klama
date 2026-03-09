<div>
    @php
        use App\Http\Helpers\Helper;
    @endphp
    <!-- Content -->
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
                                        <h3 class="text-white mb-1 fw-semibold">Maintenance Dashboard</h3>
                                        <p class="mb-0 opacity-75">{{ \Carbon\Carbon::today()->timezone('Africa/Lagos')->format('l, F j, Y') }}</p>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <div class="me-3">
                                                <small class="d-block opacity-75">Total Requests</small>
                                                <h4 class="text-white mb-0">{{ $total_requests }}</h4>
                                            </div>
                                            <div class="avatar avatar-lg">
                                                <span class="avatar-initial rounded-circle bg-white text-primary">
                                                    <i class="ti ti-tool ti-lg"></i>
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
                                        <h5 class="text-white mb-1">Total Requests</h5>
                                        <h3 class="mb-0">{{ $total_requests }}</h3>
                                    </div>
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial rounded-circle bg-white text-primary">
                                            <i class="ti ti-tool ti-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <small class="d-block opacity-75">Total Maintenance Requests</small>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card h-100 gradient-card-danger">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="text-white mb-1">Open Requests</h5>
                                        <h3 class="mb-0">{{ $open_requests }}</h3>
                                    </div>
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial rounded-circle bg-white text-danger">
                                            <i class="ti ti-alert-circle ti-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <small class="d-block opacity-75">Total Open Requests</small>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card h-100 gradient-card-info">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="text-white mb-1">Today's Requests</h5>
                                        <h3 class="mb-0">{{ $requests_today }}</h3>
                                    </div>
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial rounded-circle bg-white text-info">
                                            <i class="ti ti-calendar ti-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <small class="d-block opacity-75">Total Today's Requests</small>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card h-100 gradient-card-success">
                            <div class="card-body text-white">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="text-white mb-1">High Priority Requests</h5>
                                        <h3 class="mb-0">{{ $high_priority }}</h3>
                                    </div>
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial rounded-circle bg-white text-success">
                                            <i class="ti ti-urgent ti-sm"></i>
                                        </span>
                                    </div>
                                </div>
                                <small class="d-block opacity-75">Total High Priority Requests</small>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maintenance Schedules -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Maintenance Schedules</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        View Options
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">View More</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center g-md-8">
                                    <div class="col-12 col-md-5 d-flex flex-column">
                                        <h3 class="mb-0">{{ $total_schedule }}</h3>
                                        <small class="text-body">Total Maintenance Schedules</small>
                                    </div>
                                    <div class="col-12 col-md-7 ps-xl-8">
                                        <div id="weeklyEarningReports"></div>
                                    </div>
                                </div>
                                <div class="border rounded p-5 mt-5">
                                    <div class="row gap-4 gap-sm-0">
                                        <div class="col-12 col-sm-4">
                                            <h6 class="mb-0 fw-normal">Overdue Schedules</h6>
                                            <h4 class="my-2">{{ $overdue_schedules }}</h4>
                                            <div class="progress w-75" style="height:4px">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <h6 class="mb-0 fw-normal">Completed Schedules</h6>
                                            <h4 class="my-2">{{ $completed_schedules }}</h4>
                                            <div class="progress w-75" style="height:4px">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <h6 class="mb-0 fw-normal">Upcoming Schedules</h6>
                                            <h4 class="my-2">{{ $upcoming_schedules }}</h4>
                                            <div class="progress w-75" style="height:4px">
                                                <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <!-- Asset Tracker -->
                        <div class="mb-4">
                            <div class="card gradient-card-info">
                                <div class="card-body text-white">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h5 class="text-white mb-1">Asset Tracker</h5>
                                            <h3 class="mb-0">{{ $total_asset }}</h3>
                                        </div>
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-initial rounded-circle bg-white text-info">
                                                <i class="ti ti-database ti-sm"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <small class="d-block opacity-75">Total Assets</small>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar bg-white" style="width: 100%"></div>
                                    </div>
                                    <ul class="p-0 m-0 mt-3">
                                        <li class="d-flex gap-2 align-items-center mb-2">
                                            <span class="badge bg-label-info p-1"><i class="ti ti-circle-check ti-sm"></i></span>
                                            <div>
                                                <h6 class="mb-0 text-white">Operational Assets</h6>
                                                <small class="text-white opacity-75">{{ $active_assets }}</small>
                                            </div>
                                        </li>
                                        <li class="d-flex gap-2 align-items-center mb-2">
                                            <span class="badge bg-label-primary p-1"><i class="ti ti-tool ti-sm"></i></span>
                                            <div>
                                                <h6 class="mb-0 text-white">Under Maintenance</h6>
                                                <small class="text-white opacity-75">{{ $under_maintenance_assets }}</small>
                                            </div>
                                        </li>
                                        <li class="d-flex gap-2 align-items-center">
                                            <span class="badge bg-label-warning p-1"><i class="ti ti-trash ti-sm"></i></span>
                                            <div>
                                                <h6 class="mb-0 text-white">Decommissioned</h6>
                                                <small class="text-white opacity-75">{{ $decommissioned_assets }}</small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Technicians Available -->
                        <div class="mb-4">
                            <div class="card gradient-card-primary">
                                <div class="card-body text-white">
                                    <h5 class="text-white mb-3">Technicians Available</h5>
                                    <ul class="p-0 m-0">
                                        @forelse($technicians as $technician)
                                            <li class="d-flex justify-content-between align-items-center mb-2">
                                                <span>{{ $technician->name }}</span>
                                                <span class="badge bg-white text-primary">{{ $technician->phone }}</span>
                                            </li>
                                        @empty
                                            <p class="text-white opacity-75 mb-0">No technicians available</p>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Maintenance Management Action -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card h-100 gradient-card-primary">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="text-white mb-1">Manage Maintenance</h5>
                                <p class="text-white opacity-75 mb-2">View requests or manage schedules</p>
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
    <!-- / Content -->
</div>