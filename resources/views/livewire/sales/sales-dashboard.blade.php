<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white border-0 shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="text-white mb-1 fw-semibold">Sales and Marketing Dashboard</h3>
                            <p class="mb-0 opacity-75">{{ \Carbon\Carbon::today()->timezone('Africa/Lagos')->format('l, F j, Y') }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="me-3">
                                    <small class="d-block opacity-75">Active Coupons</small>
                                    <h4 class="text-white mb-0">{{ $active_coupons ?? 0 }}</h4>
                                </div>
                                <div class="avatar avatar-lg">
                                    <span class="avatar-initial rounded-circle bg-white text-primary">
                                        <i class="ti ti-ticket ti-lg"></i>
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
                            <h5 class="text-white mb-1">Total Coupons</h5>
                            <h3 class="mb-0">{{ $total_coupons ?? 0 }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-primary">
                                <i class="ti ti-ticket ti-sm"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block opacity-75">All created coupons</small>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ (($total_coupons ?? 0) / (($total_coupons ?? 1) ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-success">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="text-white mb-1">Active Coupons</h5>
                            <h3 class="mb-0">{{ $active_coupons ?? 0 }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-success">
                                <i class="ti ti-check ti-sm"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block opacity-75">Not used, not expired</small>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ (($active_coupons ?? 0) / (($total_coupons ?? 1) ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-info">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="text-white mb-1">Expired Coupons</h5>
                            <h3 class="mb-0">{{ $expired_coupons ?? 0 }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-info">
                                <i class="ti ti-clock ti-sm"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block opacity-75">Past end date</small>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ (($expired_coupons ?? 0) / (($total_coupons ?? 1) ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-danger">
                <div class="card-body text-white">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="text-white mb-1">Used Coupons</h5>
                            <h3 class="mb-0">{{ $used_coupons ?? 0 }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-danger">
                                <i class="ti ti-chart-bar ti-sm"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block opacity-75">Total times used</small>
                    <div class="progress mt-2" style="height: 4px;">
                        <div class="progress-bar bg-white" style="width: {{ (($used_coupons ?? 0) / (($total_coupons ?? 1) ?: 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coupon Trends Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Coupon Usage Trends (Last 7 Days)</h5>
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
                    <canvas id="couponTrendsChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Coupon Management Action -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card h-100 gradient-card-primary">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="text-white mb-1">Manage Coupons</h5>
                            <p class="text-white opacity-75 mb-2">Create or edit your coupons to boost sales</p>
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
        // Coupon Trends Chart
        const couponTrendsCtx = document.getElementById('couponTrendsChart').getContext('2d');
        const couponTrendsData = @json($coupon_trends ?? []);
        new Chart(couponTrendsCtx, {
            type: 'line',
            data: {
                labels: couponTrendsData.map(item => item.date),
                datasets: [{
                    label: 'Coupon Usage',
                    data: couponTrendsData.map(item => item.usage),
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
                            text: 'Usage Count',
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