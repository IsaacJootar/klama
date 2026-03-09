<?php

namespace App\Livewire\General;

use Livewire\Component;
<<<<<<< HEAD
use App\Models\Room;
use App\Models\KitchenStoreItems;
use App\Models\Roomcategory;
use App\Models\FnbOrder;
use App\Models\FnbMenu;
use App\Models\HotelExpense;
use App\Models\HotelIncome;
use App\Models\Reservation;
use App\Models\SwapRoom;
use App\Models\HouseLaundryRequest;
use App\Models\Roomallocation;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Title;


#[Title('General Manager\'s Dashboard ')]
class GeneralDashboard extends Component
{
    public $total_rooms;
    public $available_rooms;
    public $total_reservations;
    public $reservations_today;
    public $total_orders;
    public $orders_today;
    public $orders_this_week;
    public $orders_this_month;
    public $total_revenue_today;
    public $total_profit_today;
    public $expenses_today;
    public $reservations_this_week;
    public $reservations_this_month;
    public $occupancy_rate;
    public $occupied_today;
    public $room_categories;
    public $total_menu_items;
    public $available_menu_items;
    public $total_store_items;
    public $low_stock_items;
    public $out_of_stock_items;
    public $total_revenue_week;
    public $total_revenue_month;
    public $total_profit_week;
    public $total_profit_month;
    public $expenses_week;
    public $expenses_month;
    public $laundry_revenue_today;
    public $laundry_requests_today;
    public $others_income_today;
    public $others_transactions_today;
    public $recent_reservations;
    public $recent_orders;
    public $weekly_data;
    public $monthly_data;

    public function mount()
    {
        $today = Carbon::today()->format('Y-m-d');

        // Total Rooms
        $this->total_rooms = Room::count();

        // Available Rooms
        $this->available_rooms = Roomallocation::where(function ($query) use ($today) {
            $query->whereDate('checkin', '>', $today)
                  ->whereDate('checkout', '>', $today);
        })->orWhere('checkin', '1986-09-01')
          ->where('status', 'Available')
          ->count();

        // Total Reservations
        $this->total_reservations = Reservation::count();
        $this->reservations_today = Reservation::whereDate('created_at', $today)->count();

        // Total Orders
        $this->total_orders = FnbOrder::count();
        $this->orders_today = FnbOrder::whereDate('created_at', $today)->count();
        $this->orders_this_week = FnbOrder::whereBetween('created_at', [
            Carbon::today()->startOfWeek(),
            Carbon::today()->endOfWeek()
        ])->count();
        $this->orders_this_month = FnbOrder::whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->count();

        // Laundry Revenue and Requests Today
        $this->laundry_revenue_today = HouseLaundryRequest::whereDate('created_at', $today)->sum('amount_received');
        $this->laundry_requests_today = HouseLaundryRequest::whereDate('created_at', $today)->count();

        // Others Income Today
        $this->others_income_today = HotelIncome::where('income_date', $today)
            ->whereNotIn('section', ['Reservations', 'Food & Beverage', 'Laundry'])
            ->sum('amount');
        $this->others_transactions_today = HotelIncome::where('income_date', $today)
            ->whereNotIn('section', ['Reservations', 'Food & Beverage', 'Laundry'])
            ->count();

        // Total Revenue Today
        $reservation_revenue = Reservation::whereDate('created_at', $today)->sum('total_amount');
        $swap_revenue = SwapRoom::whereDate('created_at', $today)->sum('swap_value');
        $total_reservation_revenue = $reservation_revenue + $swap_revenue;
        $fnb_revenue = FnbOrder::whereDate('created_at', $today)->sum('price');
        $this->total_revenue_today = $total_reservation_revenue + $fnb_revenue + $this->laundry_revenue_today + $this->others_income_today;

        // Expenses Today
        $this->expenses_today = HotelExpense::where('expense_date', $today)->sum('amount');

        // Total Profit Today
        $this->total_profit_today = $this->total_revenue_today - $this->expenses_today;

        // Reservations This Week
        $this->reservations_this_week = Reservation::whereBetween('created_at', [
            Carbon::today()->startOfWeek(),
            Carbon::today()->endOfWeek()
        ])->count();

        // Reservations This Month
        $this->reservations_this_month = Reservation::whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->count();

        // Occupancy Rate
        $this->occupied_today = $this->total_rooms - $this->available_rooms;
        $this->occupancy_rate = $this->total_rooms > 0 ? round(($this->occupied_today / $this->total_rooms) * 100, 2) : 0;

        // Room Categories
        $this->room_categories = Roomcategory::count();

        // Total Menu Items
        $this->total_menu_items = FnbMenu::count();
        $this->available_menu_items = FnbMenu::where('available', 1)->count();

        // Total Store Items
        $this->total_store_items = KitchenStoreItems::count();
        $this->low_stock_items = 0; // No stock column in fnb_kitchen_store_items
        $this->out_of_stock_items = 0; // No stock column in fnb_kitchen_store_items

        // Weekly Revenue
        $reservation_revenue_week = Reservation::whereBetween('created_at', [
            Carbon::today()->startOfWeek(),
            Carbon::today()->endOfWeek()
        ])->sum('total_amount');
        $swap_revenue_week = SwapRoom::whereBetween('created_at', [
            Carbon::today()->startOfWeek(),
            Carbon::today()->endOfWeek()
        ])->sum('swap_value');
        $total_reservation_revenue_week = $reservation_revenue_week + $swap_revenue_week;
        $fnb_revenue_week = FnbOrder::whereBetween('created_at', [
            Carbon::today()->startOfWeek(),
            Carbon::today()->endOfWeek()
        ])->sum('price');
        $laundry_revenue_week = HouseLaundryRequest::whereBetween('created_at', [
            Carbon::today()->startOfWeek(),
            Carbon::today()->endOfWeek()
        ])->sum('amount_received');
        $others_revenue_week = HotelIncome::whereBetween('created_at', [
            Carbon::today()->startOfWeek(),
            Carbon::today()->endOfWeek()
        ])
            ->whereNotIn('section', ['Reservations', 'Food & Beverage', 'Laundry'])
            ->sum('amount');
        $this->total_revenue_week = $total_reservation_revenue_week + $fnb_revenue_week + $laundry_revenue_week + $others_revenue_week;

        // Monthly Revenue
        $reservation_revenue_month = Reservation::whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->sum('total_amount');
        $swap_revenue_month = SwapRoom::whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->sum('swap_value');
        $total_reservation_revenue_month = $reservation_revenue_month + $swap_revenue_month;
        $fnb_revenue_month = FnbOrder::whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->sum('price');
        $laundry_revenue_month = HouseLaundryRequest::whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->sum('amount_received');
        $others_revenue_month = HotelIncome::whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->whereNotIn('section', ['Reservations', 'Food & Beverage', 'Laundry'])
            ->sum('amount');
        $this->total_revenue_month = $total_reservation_revenue_month + $fnb_revenue_month + $laundry_revenue_month + $others_revenue_month;

        // Weekly and Monthly Expenses
        $this->expenses_week = HotelExpense::whereBetween('expense_date', [
            Carbon::today()->startOfWeek()->format('Y-m-d'),
            Carbon::today()->endOfWeek()->format('Y-m-d')
        ])->sum('amount');
        $this->expenses_month = HotelExpense::whereMonth('expense_date', Carbon::today()->month)
            ->whereYear('expense_date', Carbon::today()->year)
            ->sum('amount');

        // Weekly and Monthly Profit
        $this->total_profit_week = $this->total_revenue_week - $this->expenses_week;
        $this->total_profit_month = $this->total_revenue_month - $this->expenses_month;

        // Recent Reservations
        $this->recent_reservations = Reservation::select('fullname', 'reservation_id', 'checkin', 'checkout')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Recent Orders
        $this->recent_orders = FnbOrder::select('order_name', 'order_code', 'price', 'created_at as order_date')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Weekly Data for Chart
        $this->weekly_data = Reservation::selectRaw('DATE(created_at) as date, COUNT(*) as reservations')
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()])
            ->groupBy('date')
            ->get()
            ->map(function ($item) {
                $item->orders = FnbOrder::whereDate('created_at', $item->date)->count();
                return $item;
            });

        // Monthly Data for Chart
        $this->monthly_data = Reservation::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as revenue')
            ->whereBetween('created_at', [Carbon::today()->subMonths(11), Carbon::today()])
            ->groupBy('month')
            ->get()
            ->map(function ($item) {
                $item->expenses = HotelExpense::whereRaw('DATE_FORMAT(expense_date, "%Y-%m") = ?', [$item->month])
                    ->sum('amount');
                return $item;
            });
    }

=======
use Livewire\Attributes\Title;
#[Title('GM-DASHBOARD')]
class GeneralDashboard extends Component
{
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
    public function render()
    {
        return view('livewire.general.general-dashboard')->layout('layouts.general');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> af17489a4476af6b8ac0e130fbe8c70cf0876cfa
