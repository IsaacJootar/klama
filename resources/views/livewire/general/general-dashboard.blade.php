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
