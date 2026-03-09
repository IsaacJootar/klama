<?php
use App\Http\Helpers\Helper;
use Carbon\Carbon;
?>

<div>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Header Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="hero-card">
                    <div class="hero-content">
                        <div class="hero-text">
                            <h4 class="hero-title" style="color: white; font-size: 32px;">Generate Reports</h4>
                            <p class="hero-subtitle">{{ Carbon::today()->format('l, F j, Y') }}</p>
                            <div class="hero-stats">
                                <span class="hero-stat">
                                    <i class="ti ti-report-analytics me-1"></i>
                                    Financial & Operational Insights
                                </span>
                            </div>
                        </div>
                        <div class="hero-decoration">
                            <div class="floating-shape shape-1"></div>
                            <div class="floating-shape shape-2"></div>
                            <div class="floating-shape shape-3"></div>
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

        <!-- Form and Tabs Section -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Report Filters</h5>
                <!-- Tabs -->
                <nav class="nav nav-tabs mb-3">
                    <button wire:click="setActiveTab('financial')"
                            class="nav-link {{ $active_tab === 'financial' ? 'active' : '' }}"
                            type="button">Financial Reports</button>
                    <button wire:click="setActiveTab('operational')"
                            class="nav-link {{ $active_tab === 'operational' ? 'active' : '' }}"
                            type="button">Operational Reports</button>
                </nav>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="generateReport" class="row g-3">
                    <!-- Report Type -->
                    <div class="col-md-4">
                        <label for="report_type" class="form-label">Report Type</label>
                        <select wire:model="report_type" id="report_type"
                                class="form-select">
                            <option value="">Select Report Type</option>
                            @foreach ($report_types[$active_tab] as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Range -->
                    <div class="col-md-4">
                        <label for="date_range" class="form-label">Date Range</label>
                        <select wire:model.live="date_range" id="date_range"
                                class="form-select">
                            <option value="">Select Date Range</option>
                            @foreach ($date_range_options as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Section -->
                    <div class="col-md-4">
                        <label for="section" class="form-label">Section</label>
                        <select wire:model="section" id="section"
                                class="form-select">
                            <option value="">Select Section</option>
                            @foreach ($sections as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Custom Date Range -->
                    @if ($date_range === 'custom')
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" wire:model="start_date" id="start_date"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" wire:model="end_date" id="end_date"
                                   class="form-control">
                        </div>
                    @endif

                    <!-- Buttons -->
                    <div class="col-12 d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-report me-1"></i> Generate Report
                        </button>
                        @if ($report_data)
                            <a href="{{ route('report-preview') }}" target="_blank" class="btn btn-primary">
                                <i class="ti ti-printer me-1"></i> Print Preview
                            </a>
                            <button wire:click="exportCsv" class="btn btn-primary">
                                <i class="ti ti-download me-1"></i> Export CSV
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Report Output Section -->
        @if ($report_data)
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $report_title }}</h5>
                    <span class="text-muted">
                        Date Range: {{ \Carbon\Carbon::parse(session('start_date'))->format('d M Y') }} - {{ \Carbon\Carbon::parse(session('end_date'))->format('d M Y') }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <!-- Revenue by Section -->
                        @if ($report_type === 'revenue_by_section')
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Section</th>
                                        <th>Gross Revenue</th>
                                        <th>Coupon Discounts</th>
                                        <th>Net Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data as $section => $data)
                                        <tr>
                                            <td>{{ $section }}</td>
                                            <td>{{ Helper::format_currency($data['gross_revenue']) }}</td>
                                            <td>{{ Helper::format_currency($data['coupon_discounts']) }}</td>
                                            <td>{{ Helper::format_currency($data['net_revenue']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Expense by Section -->
                        @if ($report_type === 'expense_by_section')
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Section</th>
                                        <th>Total Expense</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data as $section => $expense)
                                        <tr>
                                            <td>{{ $section }}</td>
                                            <td>{{ Helper::format_currency($expense) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Profit by Section -->
                        @if ($report_type === 'profit_by_section')
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Section</th>
                                        <th>Gross Revenue</th>
                                        <th>Coupon Discounts</th>
                                        <th>Net Revenue</th>
                                        <th>Expense</th>
                                        <th>Profit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data as $section => $data)
                                        <tr>
                                            <td>{{ $section }}</td>
                                            <td>{{ Helper::format_currency($data['gross_revenue']) }}</td>
                                            <td>{{ Helper::format_currency($data['coupon_discounts']) }}</td>
                                            <td>{{ Helper::format_currency($data['net_revenue']) }}</td>
                                            <td>{{ Helper::format_currency($data['expense']) }}</td>
                                            <td>{{ Helper::format_currency($data['profit']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Occupancy Analysis -->
                        @if ($report_type === 'occupancy_analysis')
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Total Rooms</h6>
                                            <p class="card-text text-xl font-semibold">{{ $report_data['total_rooms'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Occupancy Rate</h6>
                                            <p class="card-text text-xl font-semibold">{{ $report_data['occupancy_rate'] }}%</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Occupied Days</h6>
                                            <p class="card-text text-xl font-semibold">{{ $report_data['occupied_days'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Total Possible Days</h6>
                                            <p class="card-text text-xl font-semibold">{{ $report_data['total_possible_days'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="mb-3">Category Breakdown</h6>
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Category</th>
                                        <th>Allocations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data['category_breakdown'] as $category)
                                        <tr>
                                            <td>{{ $category['category'] }}</td>
                                            <td>{{ $category['allocations'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Guest Activity -->
                        @if ($report_type === 'guest_activity')
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Guest Name</th>
                                        <th>Reservation ID</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th>Reservation Amount</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data as $guest)
                                        <tr>
                                            <td>{{ $guest['fullname'] }}</td>
                                            <td>{{ $guest['reservation_id'] }}</td>
                                            <td>{{ $guest['checkin'] }}</td>
                                            <td>{{ $guest['checkout'] }}</td>
                                            <td>{{ Helper::format_currency($guest['total_amount']) }}</td>
                                         
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Room Category Performance -->
                        @if ($report_type === 'room_category_performance')
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Category</th>
                                        <th>Allocations</th>
                                        <th>Revenue</th>
                                        <th>Avg. Revenue per Allocation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data as $category => $data)
                                        <tr>
                                            <td>{{ $category }}</td>
                                            <td>{{ $data['allocations'] }}</td>
                                            <td>{{ Helper::format_currency($data['revenue']) }}</td>
                                            <td>{{ Helper::format_currency($data['average_revenue_per_allocation']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Daily Transaction Summary -->
                        @if ($report_type === 'daily_transaction_summary')
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Reservations</th>
                                        <th>F&B Orders</th>
                                        <th>Laundry Requests</th>
                                        <th>Reservation Revenue</th>
                                        <th>F&B Revenue</th>
                                        <th>Laundry Revenue</th>
                                        <th>General Revenue</th>
                                        <th>Expenses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data as $date => $data)
                                        <tr>
                                            <td>{{ $date }}</td>
                                            <td>{{ $data['reservations'] }}</td>
                                            <td>{{ $data['fnb_orders'] }}</td>
                                            <td>{{ $data['laundry_requests'] }}</td>
                                            <td>{{ Helper::format_currency($data['reservation_revenue']) }}</td>
                                            <td>{{ Helper::format_currency($data['fnb_revenue']) }}</td>
                                            <td>{{ Helper::format_currency($data['laundry_revenue']) }}</td>
                                            <td>{{ Helper::format_currency($data['general_revenue']) }}</td>
                                            <td>{{ Helper::format_currency($data['expenses']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- F&B Menu Performance -->
                        @if ($report_type === 'fnb_menu_performance')
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Menu Item</th>
                                        <th>Category</th>
                                        <th>Unit Price</th>
                                        <th>Total Quantity</th>
                                        <th>Total Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data as $item => $data)
                                        <tr>
                                            <td>{{ $item }}</td>
                                            <td>{{ $data['category'] }}</td>
                                            <td>{{ Helper::format_currency($data['unit_price']) }}</td>
                                            <td>{{ $data['total_quantity'] }}</td>
                                            <td>{{ Helper::format_currency($data['total_revenue']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        <!-- Kitchen Inventory Status -->
                        @if ($report_type === 'kitchen_inventory_status')
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Item</th>
                                        <th>Category</th>
                                        <th>Measurement</th>
                                        <th>Current Quantity</th>
                                        <th>Added</th>
                                        <th>Deducted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($report_data as $item => $data)
                                        <tr>
                                            <td>{{ $item }}</td>
                                            <td>{{ $data['category'] }}</td>
                                            <td>{{ $data['measurement_tag'] }}</td>
                                            <td>{{ $data['current_quantity'] }}</td>
                                            <td>{{ $data['added'] }}</td>
                                            <td>{{ $data['deducted'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .hero-card {
            background: linear-gradient(135deg, #4e73df, #224abe);
            border-radius: 10px;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        .hero-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .hero-text {
            flex: 1;
        }
        .hero-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .hero-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            margin-bottom: 15px;
        }
        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .hero-stat {
            color: white;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .hero-decoration {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 150px;
            opacity: 0.2;
        }
        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        .shape-1 { width: 80px; height: 80px; top: 20px; right: 20px; }
        .shape-2 { width: 50px; height: 50px; bottom: 30px; right: 50px; }
        .shape-3 { width: 60px; height: 60px; top: 50%; right: 10px; }
    </style>
</div>