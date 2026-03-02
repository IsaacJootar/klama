@php
    use App\Http\Helpers\Helper;
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ session('report_title') }} - Print Preview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons@2.22.0/tabler-icons.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f8f9fa; }
        .hero-card {
            background: linear-gradient(135deg, #4e73df, #224abe);
            border-radius: 10px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
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
            color: white;
            font-size: 32px;
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
        .card { margin-bottom: 20px; }
        .table th, .table td { vertical-align: middle; }
        @media print {
            body { margin: 0; background: white; }
            .no-print { display: none; }
            .hero-card { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="container-xxl">
        <div class="hero-card">
            <div class="hero-content">
                <div class="hero-text">
                    <h4 class="hero-title">{{ session('report_title') }}</h4>
                    <p class="hero-subtitle">
                        Date Range: {{ \Carbon\Carbon::parse(session('start_date'))->format('d M Y') }} - {{ \Carbon\Carbon::parse(session('end_date'))->format('d M Y') }}
                    </p>
                    <div class="hero-stats">
                        <span class="hero-stat">
                            <i class="ti ti-report-analytics me-1"></i>
                            {{ session('active_tab') === 'financial' ? 'Financial' : 'Operational' }} Report
                        </span>
                    </div>
                </div>
                <div class="hero-decoration">
                    <div class="floating-shape shape-1"></div>
                    <div class="floating-shape shape-2"></div>
                    <div class="floating-shape shape-3"></div>
                </div>
            </div>
        </div>

        <!-- Report Content -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    @php
                        $report_data = session('report_data');
                        $report_type = session('report_type');
                    @endphp

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
                                    <th>F&B Spending</th>
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
                                        <td>{{ Helper::format_currency($guest['fnb_orders']) }}</td>
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

        <!-- Action Buttons -->
        <div class="no-print d-flex gap-2 justify-content-center">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="ti ti-printer me-1"></i> Print
            </button>
          
        </div>
    </div>
</body>
</html>