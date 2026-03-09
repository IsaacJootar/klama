<<<<<<< HEAD
@php
    use App\Http\Helpers\Helper;
    use Carbon\Carbon;
@endphp
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="hero-card">
                <div class="hero-content">
                    <div class="hero-text">
                       <h4 class="hero-title" style="color: white; font-size: 32px;">General Manager's Dashboard</h4>

                        <p class="hero-subtitle">{{ Carbon::today()->format('l, F j, Y') }}</p>
                        <div class="hero-stats">
                            <span class="hero-stat">
                                <i class="fa-solid fa-chart-line"></i>
                                {{ $occupancy_rate ?? 0 }}% Occupancy
                            </span>
                            <span class="hero-stat">
                                <i class="fa-solid fa-money-bill"></i>
                                Total Revenue Today: {{ Helper::format_currency($total_revenue_today ?? 0) }}
                            </span>
                            <span class="hero-stat">
                                <i class="fa-solid fa-wallet"></i>
                                Total Profit Today: {{ Helper::format_currency($total_profit_today ?? 0) }}
                            </span>
                        </div>
                        
                    </div></br>
                    <p>
                     <a href="{{ route('occupancy-list') }}" target="_blank" class="btn btn-primary"> Print Occupancy List
            </a>
            </p>
                    <div class="hero-decoration">
                        <div class="floating-shape shape-1"></div>
                        <div class="floating-shape shape-2"></div>
                        <div class="floating-shape shape-3"></div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    <!-- Primary Metrics Row -->
    <div class="row mb-4">
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card h-100 gradient-card-softgreen">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Total Rooms</h5>
                            <h3 class="mb-0">{{ $total_rooms ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-softgreen-light text-softgreen">
                                <i class="fa-solid fa-building"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Available: {{ $available_rooms ?? 'N/A' }}</small>
                    <div class="progress mt-2" style="height: 6px; background: rgba(90, 75, 255, 0.16);">
                        <div class="progress-bar bg-white" style="width: {{ ($total_rooms && $total_rooms > 0) ? ($available_rooms / $total_rooms * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card h-100 gradient-card-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Total Reservations</h5>
                            <h3 class="mb-0">{{ $total_reservations ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-primary-light text-primary">
                                <i class="fa-solid fa-bookmark"></i>
                            </span>
                        </div>
                          
                    </div>
                    <small class="d-block text-muted">Today: {{ $reservations_today ?? 'N/A' }}</small>
                    <div class="progress mt-2" style="height: 6px; background: rgba(90, 75, 255, 0.16);">
                        <div class="progress-bar bg-white" style="width: {{ ($total_reservations && $total_reservations > 0) ? ($reservations_today / $total_reservations * 100) : 0 }}%"></div>
                        
                    </div>
                </div>
                               <a href="{{ url('/general/reservation-calendar') }}" 
   class="btn btn-primary d-inline-flex align-items-center gap-1" 
   target="_blank" 
   rel="noopener noreferrer">
   <i class="bi bi-calendar-event"></i> Full Calendar
</a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card h-100 card-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Total Orders</h5>
                            <h3 class="mb-0">{{ $total_orders ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-danger-light text-danger">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Today: {{ $orders_today ?? 'N/A' }}</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-danger" style="width: {{ ($total_orders && $total_orders > 0) ? ($orders_today / $total_orders * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card h-100 card-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Total Revenue Today</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($total_revenue_today ?? 0) }}</h3>
                        </div>
                        
                    </div>
                    <small class="d-block text-muted">Expenses: {{ Helper::format_currency($expenses_today ?? 0) }}</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: {{ ($total_revenue_today && $total_revenue_today > 0) ? ($expenses_today / $total_revenue_today * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card h-100 card-laundry">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Laundry Revenue Today</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($laundry_revenue_today ?? 0) }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-laundry-light text-laundry">
                                <i class="fa-solid fa-shirt"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">From {{ $laundry_requests_today ?? 0 }} requests</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-laundry" style="width: {{ ($laundry_requests_today && $laundry_requests_today > 0) ? ($laundry_requests_today / ($laundry_requests_today + 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card h-100 card-others">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Others Income Today</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($others_income_today ?? 0) }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-others-light text-others">
                                <i class="fa-solid fa-coins"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">From {{ $others_transactions_today ?? 0 }} transactions</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-others" style="width: {{ ($others_transactions_today && $others_transactions_today > 0) ? ($others_transactions_today / ($others_transactions_today + 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reservations Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Reservations Statistics <span class="badge bg-label-softgreen ms-2">Reservations</span></h4>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Reservations This Week</h5>
                            <h3 class="mb-0">{{ $reservations_this_week ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-success-light text-success">
                                <i class="fa-solid fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">From {{ $reservations_today ?? 'N/A' }} today</small>
                    <div class="progress mt-2" style="height: 6px; background: rgba(90, 75, 255, 0.16);">
                        <div class="progress-bar bg-white" style="width: {{ ($reservations_this_week && $reservations_this_week > 0) ? ($reservations_today / $reservations_this_week * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-black">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Reservations This Month</h5>
                            <h3 class="mb-0">{{ $reservations_this_month ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-white text-white">
                                <i class="fa-solid fa-calendar-week"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">From {{ $reservations_today ?? 'N/A' }} today</small>
                    <div class="progress mt-2" style="height: 6px; background: rgba(90, 75, 255, 0.16);">
                        <div class="progress-bar bg-white" style="width: {{ ($reservations_this_month && $reservations_this_month > 0) ? ($reservations_today / $reservations_this_month * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 card-teal">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Occupancy Rate</h5>
                            <h3 class="mb-0">{{ $occupancy_rate ?? 0 }}%</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-teal-light text-teal">
                                <i class="fa-solid fa-chart-line"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">From {{ $occupied_today ?? 'N/A' }} rooms</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-teal" style="width: {{ $occupancy_rate ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 card-indigo">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Room Categories</h5>
                            <h3 class="mb-0">{{ $room_categories ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-indigo-light text-indigo">
                                <i class="fa-solid fa-building"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Total: {{ $total_rooms ?? 'N/A' }} rooms</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-indigo" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FNB Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">FNB Statistics <span class="badge bg-label-teal ms-2">Kitchen & Bar</span></h4>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-orange">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Total Menu Items</h5>
                            <h3 class="mb-0">{{ $total_menu_items ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-orange-light text-orange">
                                <i class="fa-solid fa-utensils"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Available: {{ $available_menu_items ?? 'N/A' }}</small>
                    <div class="progress mt-2" style="height: 6px; background: rgba(90, 75, 255, 0.16);">
                        <div class="progress-bar bg-white" style="width: {{ ($total_menu_items && $total_menu_items > 0) ? ($available_menu_items / $total_menu_items * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 gradient-card-cyan">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Total Store Items</h5>
                            <h3 class="mb-0">{{ $total_store_items ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-cyan-light text-cyan">
                                <i class="fa-solid fa-box"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Low Stock: {{ $low_stock_items ?? 'N/A' }}</small>
                    <div class="progress mt-2" style="height: 6px; background: rgba(90, 75, 255, 0.16);">
                        <div class="progress-bar bg-white" style="width: {{ ($total_store_items && $total_store_items > 0) ? ($low_stock_items / $total_store_items * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 card-pink">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Low Stock Items</h5>
                            <h3 class="mb-0">{{ $low_stock_items ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-pink-light text-pink">
                                <i class="fa-solid fa-exclamation"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Out of Stock: {{ $out_of_stock_items ?? 'N/A' }}</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-pink" style="width: {{ ($total_store_items && $total_store_items > 0) ? ($low_stock_items / $total_store_items * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 card-red">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Out of Stock Items</h5>
                            <h3 class="mb-0">{{ $out_of_stock_items ?? 'N/A' }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-red-light text-red">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Total: {{ $total_store_items ?? 'N/A' }}</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-red" style="width: {{ ($total_store_items && $total_store_items > 0) ? ($out_of_stock_items / $total_store_items * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Overview -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Financial Overview <span class="badge bg-label-mutedgreen ms-2">Financial</span></h4>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 gradient-card-mutedgreen">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Today's Revenue</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($total_revenue_today ?? 0) }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-mutedgreen-light text-muted">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">From {{ ($orders_today + $reservations_today + $laundry_requests_today + $others_transactions_today) ?? 'N/A' }} transactions</small>
                    <div class="progress mt-2" style="height: 6px; background: rgba(90, 75, 255, 0.16);">
                        <div class="progress-bar bg-white" style="width: {{ ($total_revenue_today && $total_revenue_today > 0) ? ($orders_today + $reservations_today + $laundry_requests_today + $others_transactions_today) / ($total_revenue_today + 1) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 card-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Weekly Revenue</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($total_revenue_week ?? 0) }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-primary-light text-primary">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">From {{ ($orders_this_week + $reservations_this_week + $laundry_requests_today + $others_transactions_today) ?? 'N/A' }} transactions</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: {{ ($total_revenue_week && $total_revenue_week > 0) ? ($orders_this_week + $reservations_this_week + $laundry_requests_today + $others_transactions_today) / ($total_revenue_week + 1) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 card-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Monthly Revenue</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($total_revenue_month ?? 0) }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-danger-light text-danger">
                                <i class="fa-solid fa-dollar-sign"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">From {{ ($orders_this_month + $reservations_this_month + $laundry_requests_today + $others_transactions_today) ?? 'N/A' }} transactions</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-danger" style="width: {{ ($orders_this_month + $reservations_this_month + $laundry_requests_today + $others_transactions_today && ($orders_this_month + $reservations_this_month + $laundry_requests_today + $others_transactions_today) > 0) ? (($orders_this_month + $reservations_this_month + $laundry_requests_today + $others_transactions_today) / ($orders_this_month + $reservations_this_month + $laundry_requests_today + $others_transactions_today + 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 card-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Today's Profit</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($total_profit_today ?? 0) }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-info-light text-info">
                                <i class="fa-solid fa-wallet"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Expenses: {{ Helper::format_currency($expenses_today ?? 0) }}</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: {{ ($total_profit_today && $total_profit_today > 0) ? ($expenses_today / ($total_profit_today + $expenses_today + 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 card-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Weekly Profit</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($total_profit_week ?? 0) }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-warning-light text-warning">
                                <i class="fa-solid fa-wallet"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Expenses: {{ Helper::format_currency($expenses_week ?? 0) }}</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: {{ ($total_profit_week && $total_profit_week > 0) ? ($expenses_week / ($total_profit_week + $expenses_week + 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 card-teal">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <h5 class="card-title mb-1">Monthly Profit</h5>
                            <h3 class="mb-0">{{ Helper::format_currency($total_profit_month ?? 0) }}</h3>
                        </div>
                        <div class="avatar avatar-sm">
                            <span class="avatar-initial rounded-circle bg-teal-light text-teal">
                                <i class="fa-solid fa-wallet"></i>
                            </span>
                        </div>
                    </div>
                    <small class="d-block text-muted">Expenses: {{ Helper::format_currency($expenses_month ?? 0) }}</small>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-teal" style="width: {{ ($total_profit_month && $total_profit_month > 0) ? ($expenses_month / ($total_profit_month + $expenses_month + 1) * 100) : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Weekly Reservations & Orders</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
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
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Monthly Revenue & Expenses</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Last 30 Days
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                            <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="mb-3">Recent Activity Logs</h4>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0"><span class="badge bg-label-teal">Reservations Logs</span></h5>
                </div>
                <div class="card-body">
                    @if($recent_reservations->isEmpty())
                        <p class="text-muted mb-0">No recent reservations</p>
                    @else
                        <ul class="list-unstyled timeline">
                            @foreach($recent_reservations as $reservation)
                                <li class="timeline-item mb-3">
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="mb-1">{{ $reservation->fullname }} - {{ $reservation->reservation_id }}</h6>
                                                <small class="text-muted">Check-in: {{ $reservation->checkin }} | Check-out: {{ $reservation->checkout }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0"><span class="badge bg-label-teal">Restaurant Order Logs</span></h5>
                </div>
                <div class="card-body">
                    @if($recent_orders->isEmpty())
                        <p class="text-muted mb-0">No recent orders</p>
                    @else
                        <ul class="list-unstyled timeline">
                            @foreach($recent_orders as $order)
                                <li class="timeline-item mb-3">
                                    <div class="timeline-content">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="mb-1">{{ $order->order_name }} - Order #{{ $order->order_code }}</h6>
                                                <small class="text-muted">Total: {{ Helper::format_currency($order->price) }} | Date: {{ $order->order_date }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: rgba(67, 97, 238, 0.1);
            --success: #2ecc71;
            --success-light: rgba(46, 204, 113, 0.1);
            --info: #00b4d8;
            --info-light: rgba(0, 255, 216, 0.1);
            --danger: #e63946;
            --danger-light: rgba(230, 57, 70, 0.1);
            --warning: #ff9f1c;
            --warning-light: rgba(255, 159, 28, 0.1);
            --purple: #7209b7;
            --purple-light: rgba(114, 9, 183, 0.1);
            --teal: #1abc9c;
            --teal-light: rgba(26, 188, 156, 0.1);
            --indigo: #3a0ca3;
            --indigo-light: rgba(58, 12, 163, 0.1);
            --orange: #f77f00;
            --orange-light: rgba(247, 127, 0, 0.1);
            --cyan: #00bbf9;
            --cyan-light: rgba(0, 187, 249, 0.1);
            --pink: #ff70a6;
            --pink-light: rgba(255, 112, 166, 0.1);
            --red: #d00000;
            --red-light: rgba(208, 0, 0, 0.1);
            --softgreen: #a7f3d0;
            --softgreen-light: rgba(167, 243, 208, 0.1);
            --lavender: #e9d5ff;
            --lavender-light: rgba(233, 213, 255, 0.1);
            --mutedgreen: #4b5563;
            --mutedgreen-light: rgba(75, 85, 99, 0.1);
            --black: #1f2937;
            --black-light: rgba(31, 41, 55, 0.1);
            --laundry: #4b5e7d;
            --laundry-light: rgba(75, 94, 125, 0.1);
            --others: #6d28d9;
            --others-light: rgba(109, 40, 217, 0.1);
            --body-bg: #f5f5f9;
            --card-bg: #ffffff;
            --card-border: #e9ecef;
            --body-color: #697a8d;
            --heading-color: #566a7f;
            --primary-gradient: linear-gradient(135deg, #5a4bff 0%, #7b6eff 100%);
            --success-gradient: linear-gradient(135deg, #2ecc71 0%, #4ade80 100%);
            --softgreen-gradient: linear-gradient(135deg, #a7f3d0 0%, #6ee7b7 100%);
            --lavender-gradient: linear-gradient(135deg, #e9d5ff 0%, #d8b4fe 100%);
            --teal-gradient: linear-gradient(135deg, #20c997 0%, #34d399 100%);
            --orange-gradient: linear-gradient(135deg, #f77f00 0%, #fb923c 100%);
            --cyan-gradient: linear-gradient(135deg, #00bbf9 0%, #22d3ee 100%);
            --mutedgreen-gradient: linear-gradient(135deg, #4b5563 0%, #6b7280 100%);
            --black-gradient: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            --laundry-gradient: linear-gradient(135deg, #4b5e7d 0%, #6b7280 100%);
            --others-gradient: linear-gradient(135deg, #6d28d9 0%, #8b5cf6 100%);
        }

        body {
            background: var(--body-bg);
            color: var(--body-color);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .container-p-y {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .hero-card {
            background: var(--primary-gradient);
            border: none;
            border-radius: 0.625rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.2s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .hero-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .hero-content {
            padding: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .hero-text {
            color: #fff;
        }

        .hero-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .hero-subtitle {
            font-size: 1rem;
            opacity: 0.75;
            margin-bottom: 1rem;
        }

        .hero-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .hero-stat {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            font-weight: 500;
            color: #fff;
            opacity: 0.9;
        }

        .hero-stat i {
            margin-right: 0.5rem;
            font-size: 1.2rem;
        }

        .hero-decoration {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .floating-shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            top: -20px;
            right: -20px;
            animation: float 6s ease-in-out infinite;
        }

        .shape-2 {
            width: 60px;
            height: 60px;
            top: 50%;
            right: 20px;
            animation: float 8s ease-in-out infinite;
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            bottom: -10px;
            right: 50px;
            animation: float 7s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0); }
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Solid Border Card Styles */
        .card-primary {
            border-top: 3px solid var(--primary);
        }
        .card-primary .progress-bar {
            background-color: var(--primary);
        }

        .card-success {
            border-top: 3px solid var(--success);
        }
        .card-success .progress-bar {
            background-color: var(--success);
        }

        .card-info {
            border-top: 3px solid var(--info);
        }
        .card-info .progress-bar {
            background-color: var(--info);
        }

        .card-danger {
            border-top: 3px solid var(--danger);
        }
        .card-danger .progress-bar {
            background-color: var(--danger);
        }

        .card-warning {
            border-top: 3px solid var(--warning);
        }
        .card-warning .progress-bar {
            background-color: var(--warning);
        }

        .card-teal {
            border-top: 3px solid var(--teal);
        }
        .card-teal .progress-bar {
            background-color: var(--teal);
        }

        .card-indigo {
            border-top: 3px solid var(--indigo);
        }
        .card-indigo .progress-bar {
            background-color: var(--indigo);
        }

        .card-orange {
            border-top: 3px solid var(--orange);
        }
        .card-orange .progress-bar {
            background-color: var(--orange);
        }

        .card-cyan {
            border-top: 3px solid var(--cyan);
        }
        .card-cyan .progress-bar {
            background-color: var(--cyan);
        }

        .card-pink {
            border-top: 3px solid var(--pink);
        }
        .card-pink .progress-bar {
            background-color: var(--pink);
        }

        .card-red {
            border-top: 3px solid var(--red);
        }
        .card-red .progress-bar {
            background-color: var(--red);
        }

        .card-laundry {
            border-top: 3px solid var(--laundry);
        }
        .card-laundry .progress-bar {
            background-color: var(--laundry);
        }

        .card-others {
            border-top: 3px solid var(--others);
        }
        .card-others .progress-bar {
            background-color: var(--others);
        }

        /* Gradient Card Styles */
        .gradient-card-primary {
            background: var(--primary-gradient);
            border: none;
            color: #fff;
        }
        .gradient-card-success {
            background: var(--success-gradient);
            border: none;
            color: #fff;
        }
        .gradient-card-softgreen {
            background: var(--softgreen-gradient);
            border: none;
            color: #fff;
        }
        .gradient-card-orange {
            background: var(--orange-gradient);
            border: none;
            color: #fff;
        }
        .gradient-card-cyan {
            background: var(--cyan-gradient);
            border: none;
            color: #fff;
        }
        .gradient-card-mutedgreen {
            background: var(--mutedgreen-gradient);
            border: none;
            color: #fff;
        }
        .gradient-card-black {
            background: var(--black-gradient);
            border: none;
            color: #fff;
        }

        .gradient-card-primary .card-title,
        .gradient-card-success .card-title,
        .gradient-card-softgreen .card-title,
        .gradient-card-orange .card-title,
        .gradient-card-cyan .card-title,
        .gradient-card-mutedgreen .card-title,
        .gradient-card-black .card-title {
            color: #fff;
            opacity: 0.9;
        }

        .gradient-card-primary .text-muted,
        .gradient-card-success .text-muted,
        .gradient-card-softgreen .text-muted,
        .gradient-card-orange .text-muted,
        .gradient-card-cyan .text-muted,
        .gradient-card-mutedgreen .text-muted,
        .gradient-card-black .text-muted {
            color: #fff !important;
            opacity: 0.7;
            font-weight: 700;
        }

        .gradient-card-primary h3,
        .gradient-card-success h3,
        .gradient-card-softgreen h3,
        .gradient-card-orange h3,
        .gradient-card-cyan h3,
        .gradient-card-mutedgreen h3,
        .gradient-card-black h3 {
            color: #fff;
        }

        .card-primary .text-muted,
        .card-success .text-muted,
        .card-info .text-muted,
        .card-danger .text-muted,
        .card-warning .text-muted,
        .card-teal .text-muted,
        .card-indigo .text-muted,
        .card-orange .text-muted,
        .card-cyan .text-muted,
        .card-pink .text-muted,
        .card-red .text-muted,
        .card-laundry .text-muted,
        .card-others .text-muted {
            font-weight: 700;
        }

        .card-header {
            background: transparent;
            border-bottom: none;
            padding: 1rem 1.75rem;
        }

        .card-title {
            color: var(--heading-color);
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .recent-activities .card-title {
            font-weight: 700;
        }

        .card-body {
            padding: 1.75rem;
        }

        h3 {
            font-size: 1.5rem;
            font-weight: 600;
        }

        h4 {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .avatar.avatar-sm {
            width: 1.5rem;
            height: 1.5rem;
            line-height: 1.5rem;
        }

        .avatar-initial {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            width: 100%;
            height: 100%;
        }

        .avatar-initial i {
            font-size: 0.9rem;
        }

        .progress {
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 0;
            height: 6px;
        }

        .progress-bar {
            border-radius: 0;
        }

        .badge.bg-label-softgreen {
            background: rgba(167, 243, 208, 0.1);
            color: var(--softgreen);
        }

        .badge.bg-label-teal {
            background: rgba(26, 188, 156, 0.1);
            color: var(--teal);
        }

        .badge.bg-label-mutedgreen {
            background: rgba(75, 85, 99, 0.1);
            color: var(--mutedgreen);
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

        .timeline {
            position: relative;
        }

        .timeline-item {
            position: relative;
            padding-left: 1.25rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.5rem;
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
        }

        .timeline-content h6 {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--heading-color);
        }

        /* Animations */
        .card, .hero-card {
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            transform: translateY(1rem);
        }

        .card:nth-child(1), .hero-card:nth-child(1) { animation-delay: 0.1s; }
        .card:nth-child(2) { animation-delay: 0.2s; }
        .card:nth-child(3) { animation-delay: 0.3s; }
        .card:nth-child(4) { animation-delay: 0.4s; }
        .card:nth-child(5) { animation-delay: 0.5s; }
        .card:nth-child(6) { animation-delay: 0.6s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-title, .hero-title {
                font-size: 1rem;
            }
            .card-body, .hero-content {
                padding: 1rem;
            }
            h3 {
                font-size: 1.25rem;
            }
            h4 {
                font-size: 1rem;
            }
            .avatar-sm {
                width: 1.25rem;
                height: 1.25rem;
                line-height: 1.25rem;
            }
            .avatar-initial i {
                font-size: 0.8rem;
            }
            .hero-stats {
                flex-direction: column;
                gap: 0.75rem;
            }
            .hero-stat {
                font-size: 0.85rem;
            }
            .hero-stat i {
                font-size: 1rem;
            }
        }
    </style>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Weekly Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        const weeklyData = @json($weekly_data ?? []);
        new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: weeklyData.map(item => item.date),
                datasets: [
                    {
                        label: 'Reservations',
                        data: weeklyData.map(item => item.reservations),
                        borderColor: '#4361ee',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Orders',
                        data: weeklyData.map(item => item.orders),
                        borderColor: '#2ecc71',
                        backgroundColor: 'rgba(46, 204, 113, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
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
                            text: 'Count',
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

        // Monthly Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyData = @json($monthly_data ?? []);
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: monthlyData.map(item => item.month),
                datasets: [
                    {
                        label: 'Revenue',
                        data: monthlyData.map(item => item.revenue),
                        backgroundColor: 'rgba(46, 204, 113, 0.8)',
                        borderColor: '#2ecc71',
                        borderWidth: 1,
                        borderRadius: 4,
                    },
                    {
                        label: 'Expenses',
                        data: monthlyData.map(item => item.expenses),
                        backgroundColor: 'rgba(230, 57, 70, 0.8)',
                        borderColor: '#e63946',
                        borderWidth: 1,
                        borderRadius: 4,
                    }
                ]
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
                            text: 'Amount',
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
=======
<div>

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row g-6">

          <!-- Sales last year -->
          <div class="col-xxl-2 col-md-4 col-sm-6">
            <div class="card h-100">
              <div class="card-header pb-3">
                <h5 class="card-title mb-1">Reservations</h5>
                <p class="card-subtitle">Last week</p>
              </div>
              <div class="card-body">
                <div id="ordersLastWeek"></div>
                <div class="d-flex justify-content-between align-items-center gap-3">
                  <h4 class="mb-0">124k</h4>
                  <small class="text-success">+12.6%</small>
                </div>
              </div>
            </div>
          </div>

          <!-- Sessions Last month -->
          <div class="col-xxl-2 col-md-4 col-sm-6">
            <div class="card h-100">
              <div class="card-header pb-0">
                <h5 class="card-title mb-1">Pick Ups</h5>
                <p class="card-subtitle">Last Year</p>
              </div>
              <div id="salesLastYear"></div>
              <div class="card-body pt-0">
                <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                  <h4 class="mb-0">175k</h4>
                  <small class="text-danger">-16.2%</small>
                </div>
              </div>
            </div>
          </div>

          <!-- Total Profit -->
          <div class="col-xxl-2 col-md-4 col-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-danger mb-3 rounded"><i class="ti ti-credit-card ti-28px"></i></div>
                <h5 class="card-title mb-1">Total Profit</h5>
                <p class="card-subtitle ">Last week</p>
                <p class="text-heading mb-3 mt-1">1.28k</p>
                <div>
                  <span class="badge bg-label-danger">-12.2%</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Total Sales -->
          <div class="col-xxl-2 col-md-5 col-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="badge p-2 bg-label-success mb-3 rounded"><i class="ti ti-credit-card ti-28px"></i></div>
                <h5 class="card-title mb-1">Total Sales</h5>
                <p class="card-subtitle ">Last week</p>
                <p class="text-heading mb-3 mt-1">24.67k</p>
                <div>
                  <span class="badge bg-label-success">+24.5%</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Revenue Growth -->
          <div class="col-xxl-4 col-md-7">
            <div class="card h-100">
              <div class="card-body d-flex justify-content-between">
                <div class="d-flex flex-column me-xl-7">
                  <div class="card-title mb-auto">
                    <h5 class="mb-2 text-nowrap">Revenue Growth</h5>
                    <p class="mb-0">Weekly Report</p>
                  </div>
                  <div class="chart-statistics">
                    <h3 class="card-title mb-1">₦74,673, 770</h3>
                    <span class="badge bg-label-success">+15.2%</span>
                  </div>
                </div>
                <div id="revenueGrowth"></div>
              </div>
            </div>
          </div>

          <!-- Earning Reports Tabs-->
          <div class="col-xl-8 col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="card-title m-0">
                  <h5 class="mb-1">Earning Reports</h5>
                  <p class="card-subtitle">Yearly Earnings Overview</p>
                </div>
                <div class="dropdown">
                  <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="earningReportsTabsId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-md text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsTabsId">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="nav nav-tabs widget-nav-tabs pb-8 gap-4 mx-1 d-flex flex-nowrap" role="tablist">
                  <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link btn active d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id" aria-controls="navs-orders-id" aria-selected="true">
                      <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-shopping-cart ti-md"></i></div>
                      <h6 class="tab-widget-title mb-0 mt-2">Orders</h6>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id" aria-controls="navs-sales-id" aria-selected="false">
                      <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-chart-bar ti-md"></i></div>
                      <h6 class="tab-widget-title mb-0 mt-2"> Sales</h6>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id" aria-controls="navs-profit-id" aria-selected="false">
                      <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-currency-dollar ti-md"></i></div>
                      <h6 class="tab-widget-title mb-0 mt-2">Profit</h6>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link btn d-flex flex-column align-items-center justify-content-center" role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id" aria-controls="navs-income-id" aria-selected="false">
                      <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-chart-pie-2 ti-md"></i></div>
                      <h6 class="tab-widget-title mb-0 mt-2">Income</h6>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link btn d-flex align-items-center justify-content-center disabled" role="tab" data-bs-toggle="tab" aria-selected="false">
                      <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-plus ti-md"></i></div>
                    </a>
                  </li>
                </ul>
                <div class="tab-content p-0 ms-0 ms-sm-2">
                  <div class="tab-pane fade show active" id="navs-orders-id" role="tabpanel">
                    <div id="earningReportsTabsOrders"></div>
                  </div>
                  <div class="tab-pane fade" id="navs-sales-id" role="tabpanel">
                    <div id="earningReportsTabsSales"></div>
                  </div>
                  <div class="tab-pane fade" id="navs-profit-id" role="tabpanel">
                    <div id="earningReportsTabsProfit"></div>
                  </div>
                  <div class="tab-pane fade" id="navs-income-id" role="tabpanel">
                    <div id="earningReportsTabsIncome"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sales last 6 months -->
          <div class="col-xl-4 col-md-6">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between pb-4">
                <div class="card-title mb-0">
                  <h5 class="mb-1">Sales</h5>
                  <p class="card-subtitle">Last 6 Months</p>
                </div>
                <div class="dropdown">
                  <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="salesLastMonthMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-md text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesLastMonthMenu">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div id="salesLastMonth"></div>
              </div>
            </div>
          </div>

          <!-- Sales By Country -->
          <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between">
                <div class="card-title mb-0">
                  <h5 class="mb-1">Bookings by States</h5>
                  <p class="card-subtitle">Monthly Bookings Overview</p>
                </div>
                <div class="dropdown">
                  <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="salesByCountry" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-md text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountry">
                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">
                  <li class="d-flex align-items-center mb-4">
                    <div class="avatar flex-shrink-0 me-4">
                      <i class="fis fi fi-us rounded-circle fs-2"></i>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <div class="d-flex align-items-center">
                          <h6 class="mb-0 me-1">₦8,567k</h6>

                        </div>
                        <small class="text-body">United states</small>
                      </div>
                      <div class="user-progress">
                        <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                          <i class='ti ti-chevron-up'></i>
                          25.8%
                        </p>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-center mb-4">
                    <div class="avatar flex-shrink-0 me-4">
                      <i class="fis fi fi-br rounded-circle fs-2"></i>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <div class="d-flex align-items-center">
                          <h6 class="mb-0 me-1">₦2,415k</h6>
                        </div>
                        <small class="text-body">Brazil</small>
                      </div>
                      <div class="user-progress">
                        <p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                          <i class='ti ti-chevron-down'></i>
                          6.2%
                        </p>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-center mb-4">
                    <div class="avatar flex-shrink-0 me-4">
                      <i class="fis fi fi-in rounded-circle fs-2"></i>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <div class="d-flex align-items-center">
                          <h6 class="mb-0 me-1">₦865k</h6>
                        </div>
                        <small class="text-body">India</small>
                      </div>
                      <div class="user-progress">
                        <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                          <i class='ti ti-chevron-up'></i>
                          12.4%
                        </p>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-center mb-4">
                    <div class="avatar flex-shrink-0 me-4">
                      <i class="fis fi fi-au rounded-circle fs-2"></i>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <div class="d-flex align-items-center">
                          <h6 class="mb-0 me-1">₦745k</h6>
                        </div>
                        <small class="text-body">Australia</small>
                      </div>
                      <div class="user-progress">
                        <p class="text-danger fw-medium mb-0 d-flex align-items-center gap-1">
                          <i class='ti ti-chevron-down'></i>
                          11.9%
                        </p>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-center mb-4">
                    <div class="avatar flex-shrink-0 me-4">
                      <i class="fis fi fi-fr rounded-circle fs-2"></i>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <div class="d-flex align-items-center">
                          <h6 class="mb-0 me-1">₦45</h6>
                        </div>
                        <small class="text-body">France</small>
                      </div>
                      <div class="user-progress">
                        <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                          <i class='ti ti-chevron-up'></i>
                          16.2%
                        </p>
                      </div>
                    </div>
                  </li>
                  <li class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-4">
                      <i class="fis fi fi-cn rounded-circle fs-2"></i>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                      <div class="me-2">
                        <div class="d-flex align-items-center">
                          <h6 class="mb-0 me-1">₦12k</h6>
                        </div>
                        <small class="text-body">China</small>
                      </div>
                      <div class="user-progress">
                        <p class="text-success fw-medium mb-0 d-flex align-items-center gap-1">
                          <i class='ti ti-chevron-up'></i>
                          14.8%
                        </p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--/ Sales By Country -->

          <!-- Project Status -->
          <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0 card-title">Project Status</h5>
                <div class="dropdown">
                  <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="projectStatusId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-md text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectStatusId">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex align-items-start">
                  <div class="badge rounded bg-label-warning p-2 me-3 rounded"><i class="ti ti-currency-dollar ti-lg"></i></div>
                  <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                    <div class="me-2">
                      <h6 class="mb-0">₦4,3742</h6>
                      <small class="text-body">Your Earnings</small>
                    </div>
                    <h6 class="mb-0 text-success">+10.2%</h6>
                  </div>
                </div>
                <div id="projectStatusChart"></div>
                <div class="d-flex justify-content-between mb-4">
                  <h6 class="mb-0">Donates</h6>
                  <div class="d-flex">
                    <p class="mb-0 me-4">₦756.26</p>
                    <p class="mb-0 text-danger">-139.34</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between">
                  <h6 class="mb-0">Podcasts</h6>
                  <div class="d-flex">
                    <p class="mb-0 me-4">₦2,207.03</p>
                    <p class="mb-0 text-success">+576.24</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Active Projects -->
          <div class="col-xxl-4 col-md-6">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between">
                <div class="card-title mb-0">
                  <h5 class="mb-1">Active Project</h5>
                  <p class="card-subtitle">Average 72% Completed</p>
                </div>
                <div class="dropdown">
                  <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="activeProjects" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-md text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="activeProjects">
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                    <a class="dropdown-item" href="javascript:void(0);">View All</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="p-0 m-0">
                  <li class="mb-4 d-flex">
                    <div class="d-flex w-50 align-items-center me-4">
                      <img src="../../assets/img/icons/brands/laravel-logo.png" alt="laravel-logo" class="me-4" width="35" />
                      <div>
                        <h6 class="mb-0">Laravel</h6>
                        <small class="text-body">eCommerce</small>
                      </div>
                    </div>
                    <div class="d-flex flex-grow-1 align-items-center">
                      <div class="progress w-100 me-4" style="height:8px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 65%" aria-valuenow="54" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                      <span class="text-muted">65%</span>
                    </div>
                  </li>
                  <li class="mb-4 d-flex">
                    <div class="d-flex w-50 align-items-center me-4">
                      <img src="../../assets/img/icons/brands/figma-logo.png" alt="figma-logo" class="me-4" width="35" />
                      <div>
                        <h6 class="mb-0">Figma</h6>
                        <small class="text-body">App UI Kit</small>
                      </div>
                    </div>
                    <div class="d-flex flex-grow-1 align-items-center">
                      <div class="progress w-100 me-4" style="height:8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 86%" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                      <span class="text-muted">86%</span>
                    </div>
                  </li>
                  <li class="mb-4 d-flex">
                    <div class="d-flex w-50 align-items-center me-4">
                      <img src="../../assets/img/icons/brands/vue-logo.png" alt="vue-logo" class="me-4" width="35" />
                      <div>
                        <h6 class="mb-0">VueJs</h6>
                        <small class="text-body">Calendar App</small>
                      </div>
                    </div>
                    <div class="d-flex flex-grow-1 align-items-center">
                      <div class="progress w-100 me-4" style="height:8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                      <span class="text-muted">90%</span>
                    </div>
                  </li>
                  <li class="mb-4 d-flex">
                    <div class="d-flex w-50 align-items-center me-4">
                      <img src="../../assets/img/icons/brands/react-logo.png" alt="react-logo" class="me-4" width="35" />
                      <div>
                        <h6 class="mb-0">React</h6>
                        <small class="text-body">Dashboard</small>
                      </div>
                    </div>
                    <div class="d-flex flex-grow-1 align-items-center">
                      <div class="progress w-100 me-4" style="height:8px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                      <span class="text-muted">37%</span>
                    </div>
                  </li>
                  <li class="mb-4 d-flex">
                    <div class="d-flex w-50 align-items-center me-4">
                      <img src="../../assets/img/icons/brands/bootstrap-logo.png" alt="bootstrap-logo" class="me-4" width="35" />
                      <div>
                        <h6 class="mb-0">Bootstrap</h6>
                        <small class="text-body">Website</small>
                      </div>
                    </div>
                    <div class="d-flex flex-grow-1 align-items-center">
                      <div class="progress w-100 me-4" style="height:8px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                      <span class="text-muted">22%</span>
                    </div>
                  </li>
                  <li class="d-flex">
                    <div class="d-flex w-50 align-items-center me-4">
                      <img src="../../assets/img/icons/brands/sketch-logo.png" alt="sketch-logo" class="me-4" width="35" />
                      <div>
                        <h6 class="mb-0">Sketch</h6>
                        <small class="text-body">Website Design</small>
                      </div>
                    </div>
                    <div class="d-flex flex-grow-1 align-items-center">
                      <div class="progress w-100 me-4" style="height:8px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 29%" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100">
                        </div>
                      </div>
                      <span class="text-muted">29%</span>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--/ Active Projects -->

          <!-- Last Transaction -->
          <div class="col-xl-6">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0 me-2">Last Transaction</h5>
                <div class="dropdown">
                  <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="teamMemberList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-md text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="teamMemberList">
                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-borderless border-top">
                  <thead class="border-bottom">
                    <tr>
                      <th>CARD</th>
                      <th>DATE</th>
                      <th>STATUS</th>
                      <th>TREND</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="pt-5">
                        <div class="d-flex justify-content-start align-items-center">
                          <div class="me-4">
                            <img src="../../assets/img/icons/payments/visa-img.png" alt="Visa" height="30">
                          </div>
                          <div class="d-flex flex-column">
                            <p class="mb-0 text-heading">*4230</p><small class="text-body">Credit</small>
                          </div>
                        </div>
                      </td>
                      <td class="pt-5">
                        <div class="d-flex flex-column">
                          <p class="mb-0 text-heading">Sent</p>
                          <small class="text-body text-nowrap">17 Mar 2022</small>
                        </div>
                      </td>
                      <td class="pt-5"><span class="badge bg-label-success">Verified</span></td>
                      <td class="pt-5">
                        <p class="mb-0 text-heading">+₦1,678</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex justify-content-start align-items-center">
                          <div class="me-4">
                            <img src="../../assets/img/icons/payments/master-card-img.png" alt="Visa" height="30">
                          </div>
                          <div class="d-flex flex-column">
                            <p class="mb-0 text-heading">*5578</p><small class="text-body">Credit</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex flex-column">
                          <p class="mb-0 text-heading">Sent</p>
                          <small class="text-body text-nowrap">12 Feb 2022</small>
                        </div>
                      </td>
                      <td><span class="badge bg-label-danger">Rejected</span></td>
                      <td>
                        <p class="mb-0 text-heading">-₦839</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex justify-content-start align-items-center">
                          <div class="me-4">
                            <img src="../../assets/img/icons/payments/american-express-img.png" alt="Visa" height="30">
                          </div>
                          <div class="d-flex flex-column">
                            <p class="mb-0 text-heading">*4567</p><small class="text-body">ATM</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex flex-column">
                          <p class="mb-0 text-heading">Sent</p>
                          <small class="text-body text-nowrap">28 Feb 2022</small>
                        </div>
                      </td>
                      <td><span class="badge bg-label-success">Verified</span></td>
                      <td>
                        <p class="mb-0 text-heading">+₦435</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex justify-content-start align-items-center">
                          <div class="me-4">
                            <img src="../../assets/img/icons/payments/visa-img.png" alt="Visa" height="30">
                          </div>
                          <div class="d-flex flex-column">
                            <p class="mb-0 text-heading">*5699</p><small class="text-body">Credit</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex flex-column">
                          <p class="mb-0 text-heading">Sent</p>
                          <small class="text-body text-nowrap">8 Jan 2022</small>
                        </div>
                      </td>
                      <td><span class="badge bg-label-secondary">Pending</span></td>
                      <td>
                        <p class="mb-0 text-heading">+₦2,345</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex justify-content-start align-items-center">
                          <div class="me-4">
                            <img src="../../assets/img/icons/payments/visa-img.png" alt="Visa" height="30">
                          </div>
                          <div class="d-flex flex-column">
                            <p class="mb-0 text-heading">*5699</p><small class="text-body">Credit</small>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex flex-column">
                          <p class="mb-0 text-heading">Sent</p>
                          <small class="text-body text-nowrap">8 Jan 2022</small>
                        </div>
                      </td>
                      <td><span class="badge bg-label-danger">Rejected</span></td>
                      <td>
                        <p class="mb-0 text-heading">-₦234</p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!--/ Last Transaction -->

          <!-- GM Dashboard -->
          <div class="col-xxl-6 order-2">
            <div class="card h-100">
              <div class="card-header d-flex justify-content-between">
                <h5 class="card-title m-0 me-2 pt-1 mb-2 d-flex align-items-center"><i class="ti ti-list-details me-3"></i> Activity Timeline</h5>
                <div class="dropdown">
                  <button class="btn btn-text-secondary rounded-pill text-muted border-0 p-2 me-n1" type="button" id="timelineWapper" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ti ti-dots-vertical ti-md text-muted"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper">
                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                  </div>
                </div>
              </div>
              <div class="card-body pb-xxl-0">
                <ul class="timeline mb-0">
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-primary"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-3">
                        <h6 class="mb-0">12 Invoices have been paid</h6>
                        <small class="text-muted">12 min ago</small>
                      </div>
                      <p class="mb-2">
                        Invoices have been paid to the company
                      </p>
                      <div class="d-flex align-items-center mb-1">
                        <div class="badge bg-lighter rounded-3">
                          <img src="../../assets/img/icons/misc/pdf.png" alt="img" width="15" class="me-2">
                          <span class="h6 mb-0 text-body">invoices.pdf</span>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-success"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-3">
                        <h6 class="mb-0">Client Meeting</h6>
                        <small class="text-muted">45 min ago</small>
                      </div>
                      <p class="mb-2">
                        Project meeting with john @10:15am
                      </p>
                      <div class="d-flex justify-content-between flex-wrap gap-2">
                        <div class="d-flex flex-wrap align-items-center">
                          <div class="avatar avatar-sm me-2">
                            <img src="../../assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                          </div>
                          <div>
                            <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                            <small>CEO of Pixinvent</small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-info"></span>
                    <div class="timeline-event">
                      <div class="timeline-header mb-3">
                        <h6 class="mb-0">Create a new project for client</h6>
                        <small class="text-muted">2 Day Ago</small>
                      </div>
                      <p class="mb-2">
                        6 team members in a project
                      </p>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap p-0">
                          <div class="d-flex flex-wrap align-items-center">
                            <ul class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar" />
                              </li>
                              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske" class="avatar pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/12.png" alt="Avatar" />
                              </li>
                              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar pull-up">
                                <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" />
                              </li>
                              <li class="avatar">
                                <span class="avatar-initial rounded-circle pull-up text-heading" data-bs-toggle="tooltip" data-bs-placement="bottom" title="3 more">+3</span>
                              </li>
                            </ul>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--/ GM Dashboard -->
        </div>

                  </div>
                  <!-- / Content -->

</div>
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
