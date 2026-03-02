@php
use App\Http\Helpers\Helper;
@endphp

<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="text-white mb-1">Kitchen & Restaurant Dashboard</h3>
                                <p class="mb-0 opacity-75">{{ date('l, F j, Y') }}</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="me-3">
                                        <small class="d-block opacity-75">Completion Rate</small>
                                        <h4 class="text-white mb-0">{{ $order_completion_rate }}%</h4>
                                    </div>
                                    <div class="avatar avatar-lg">
                                        <span class="avatar-initial rounded-circle bg-white text-primary">
                                            <i class="ti ti-chart-line ti-lg"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Metrics Row -->
        <div class="row mb-4">
            <!-- Today's Revenue -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 gradient-card-success">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5 class="text-white mb-1">Today's Revenue</h5>
                                <h3 class="mb-0">{{ Helper::format_currency($today_revenue) }}</h3>
                            </div>
                           
                        </div>
                        <small class="d-block opacity-75">From {{ $orders_today }} orders</small>
                        <div class="mt-2">
                            <span class="badge bg-white text-success">
                                @if($revenue_growth >= 0) +{{ $revenue_growth }}% @else {{ $revenue_growth }}% @endif
                            </span>
                            <small class="opacity-75 ms-1">vs last month</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Today -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 gradient-card-info">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5 class="text-white mb-1">Orders Today</h5>
                                <h3 class="mb-0">{{ $orders_today }}</h3>
                            </div>
                            
                        </div>
                        <small class="d-block opacity-75">Total orders</small>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-white" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Expenses -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 gradient-card-danger">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5 class="text-white mb-1">Today's Expenses</h5>
                                <h3 class="mb-0">{{ Helper::format_currency($expenses_today) }}</h3>
                            </div>
                          
                        </div>
                        <small class="d-block opacity-75">Daily expenditure</small>
                        <div class="mt-2">
                            <span class="badge bg-white text-danger">
                                @if($expense_growth >= 0) +{{ $expense_growth }}% @else {{ $expense_growth }}% @endif
                            </span>
                            <small class="opacity-75 ms-1">vs last month</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Store Activity -->
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 gradient-card-primary">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5 class="text-white mb-1">Store Activity</h5>
                                <h3 class="mb-0">{{ $recent_store_activity }}</h3>
                            </div>
                           
                        </div>
                        <small class="d-block opacity-75">Today's transactions</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Metrics Row -->
        <div class="row mb-4">
            <!-- Total Orders -->
            <div class="col-md-6 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-info">
                                <i class="ti ti-receipt text-white ti-lg"></i>
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $total_orders }}</h4>
                        <small class="text-muted">Total Orders</small>
                    </div>
                </div>
            </div>

            <!-- Orders This Week -->
            <div class="col-md-6 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-success">
                                <i class="ti ti-calendar-week text-white ti-lg"></i>
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $orders_this_week }}</h4>
                        <small class="text-muted">This Week</small>
                    </div>
                </div>
            </div>

            <!-- Total Menu Items -->
            <div class="col-md-6 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-info">
                                <i class="ti ti-book text-white ti-lg"></i>
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $total_menu_items }}</h4>
                        <small class="text-muted">Menu Items</small>
                    </div>
                </div>
            </div>

            <!-- Store Items -->
            <div class="col-md-6 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-primary">
                                <i class="ti ti-package text-white ti-lg"></i>
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $total_store_items }}</h4>
                        <small class="text-muted">Store Items</small>
                    </div>
                </div>
            </div>

            <!-- Low Stock Alert -->
            <div class="col-md-6 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-danger">
                                <i class="ti ti-alert-triangle text-white ti-lg"></i>
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $low_stock_items }}</h4>
                        <small class="text-muted">Low Stock</small>
                    </div>
                </div>
            </div>

            <!-- Expense Categories -->
            <div class="col-md-6 col-lg-2 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-secondary">
                                <i class="ti ti-category text-white ti-lg"></i>
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $expense_categories_count }}</h4>
                        <small class="text-muted">Expense Categories</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics Row -->
        <div class="row mb-4">
            <!-- Weekly Performance Chart -->
            <div class="col-lg-8 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Weekly Performance</h5>
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
                        <canvas id="weeklyChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Stats</h5>
                    </div>
                    <div class="card-body">
                        <!-- Weekly Stats -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">This Week</h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Orders</span>
                                <span class="badge bg-success">{{ $orders_this_week }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Revenue</span>
                                <span class="badge bg-primary">{{ Helper::format_currency($weekly_revenue) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Expenses</span>
                                <span class="badge bg-danger">{{ Helper::format_currency($weekly_expenses) }}</span>
                            </div>
                        </div>

                        <hr>

                        <!-- Monthly Stats -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">This Month</h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Orders</span>
                                <span class="badge bg-success">{{ $orders_this_month }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Revenue</span>
                                <span class="badge bg-primary">{{ Helper::format_currency($monthly_revenue) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Expenses</span>
                                <span class="badge bg-danger">{{ Helper::format_currency($monthly_expenses) }}</span>
                            </div>
                        </div>

                        <hr>

                        <!-- Menu Availability -->
                        <div>
                            <h6 class="text-muted mb-2">Menu Availability</h6>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Available Items</span>
                                <span class="badge bg-success">{{ $available_menu_items }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Unavailable Items</span>
                                <span class="badge bg-danger">{{ $unavailable_menu_items }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profit and Loss Row -->
        <div class="row">
            <!-- Profit and Loss -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Profit and Loss</h5>
                    </div>
                    <div class="card-body">
                        @if($today_revenue == 0 && $expenses_today == 0 && $weekly_revenue == 0 && $weekly_expenses == 0 && $monthly_revenue == 0 && $monthly_expenses == 0)
                            <div class="text-center py-4">
                                <i class="ti ti-chart-bar ti-3x text-muted mb-3"></i>
                                <p class="text-muted">No financial data available yet</p>
                            </div>
                        @else
                            <div class="row">
                                <!-- Today's Profit/Loss -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 gradient-card-{{ $today_profit >= 0 ? 'success' : 'danger' }}">
                                        <div class="card-body text-white">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h5 class="text-white mb-1">Today's {{ $today_profit >= 0 ? 'Profit' : 'Loss' }}</h5>
                                                    <h5 class="mb-0">{{ Helper::format_currency(abs($today_profit)) }}</h5>
                                                </div>
                                               
                                            </div>
                                            <small class="d-block opacity-75">Revenue: {{ Helper::format_currency($today_revenue) }}</small>
                                            <small class="d-block opacity-75">Expenses: {{ Helper::format_currency($expenses_today) }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Weekly Profit/Loss -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 gradient-card-{{ $weekly_profit >= 0 ? 'success' : 'danger' }}">
                                        <div class="card-body text-white">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h5 class="text-white mb-1">Weekly {{ $weekly_profit >= 0 ? 'Profit' : 'Loss' }}</h5>
                                                    <h5 class="mb-0">{{ Helper::format_currency(abs($weekly_profit)) }}</h5>
                                                </div>
                                              
                                            </div>
                                            <small class="d-block opacity-75">Revenue: {{ Helper::format_currency($weekly_revenue) }}</small>
                                            <small class="d-block opacity-75">Expenses: {{ Helper::format_currency($weekly_expenses) }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Monthly Profit/Loss -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 gradient-card-{{ $monthly_profit >= 0 ? 'success' : 'danger' }}">
                                        <div class="card-body text-white">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h5 class="text-white mb-1">Monthly {{ $monthly_profit >= 0 ? 'Profit' : 'Loss' }}</h5>
                                                    <h5 class="mb-0">{{ Helper::format_currency(abs($monthly_profit)) }}</h5>
                                                </div>
                                                
                                            </div>
                                            <small class="d-block opacity-75">Revenue: {{ Helper::format_currency($monthly_revenue) }}</small>
                                            <small class="d-block opacity-75">Expenses: {{ Helper::format_currency($monthly_expenses) }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Top Categories -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Top Categories</h5>
                    </div>
                    <div class="card-body">
                        @if($top_categories->count() > 0)
                            @foreach($top_categories as $category)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="mb-1">{{ $category->category }}</h6>
                                    <small class="text-muted">{{ $category->menu_count }} items</small>
                                </div>
                                <div class="progress" style="width: 60px; height: 6px;">
                                    <div class="progress-bar bg-primary" style="width: {{ ($category->menu_count / $total_menu_items) * 100 }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="ti ti-category ti-3x text-muted mb-3"></i>
                                <p class="text-muted">No categories available</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
<!-- Monthly Revenue and Expenses Trend -->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="card-title mb-0">Financial Trend (Last 12 Months)</h5>
                <div class="d-flex flex-column flex-md-row gap-2 mt-2 mt-md-0">
                    <span class="badge bg-success text-wrap">Total Revenue: {{ Helper::format_currency($total_revenue) }}</span>
                    <span class="badge bg-danger text-wrap">Total Expenses: {{ Helper::format_currency($total_expenses) }}</span>
                    <span class="badge bg-info text-wrap">This Month: {{ Helper::format_currency($monthly_revenue) }}</span>
                </div>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

        <!-- Weekly Expenses Chart -->
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Weekly Expenses (Last 7 Days)</h5>
                        <div class="d-flex gap-2">
                            <span class="badge bg-danger">Total: {{ Helper::format_currency($weekly_expenses) }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="expensesChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for gradient cards -->
    <style>
    .gradient-card-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
    }

    .gradient-card-info {
        background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
        border: none;
    }

    .gradient-card-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        border: none;
    }

    .gradient-card-primary {
        background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
        border: none;
    }

    .gradient-card-danger {
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        border: none;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
        transition: all 0.15s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .avatar-initial {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Weekly Performance Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        const weeklyData = @json($weekly_orders_chart);
        
        new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: weeklyData.map(item => item.date),
                datasets: [
                    {
                        label: 'Orders',
                        data: weeklyData.map(item => item.orders),
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        tension: 0.4,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Revenue',
                        data: weeklyData.map(item => item.revenue),
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Orders'
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Revenue'
                        },
                        grid: {
                            drawOnChartArea: false,
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });

        // Monthly Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueData = @json($revenue_chart);
        
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: revenueData.map(item => item.month),
                datasets: [{
                    label: 'Monthly Revenue',
                    data: revenueData.map(item => item.revenue),
                    backgroundColor: 'rgba(0, 123, 255, 0.8)',
                    borderColor: '#007bff',
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
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Revenue'
                        }
                    }
                }
            }
        });

        // Weekly Expenses Chart
        const expensesCtx = document.getElementById('expensesChart').getContext('2d');
        const expensesData = @json($weekly_expenses_chart);
        
        new Chart(expensesCtx, {
            type: 'bar',
            data: {
                labels: expensesData.map(item => item.date),
                datasets: [{
                    label: 'Daily Expenses',
                    data: expensesData.map(item => item.expenses),
                    backgroundColor: 'rgba(220, 53, 69, 0.8)',
                    borderColor: '#dc3545',
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
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Expenses'
                        }
                    }
                }
            }
        });
    });
    </script>
</div>