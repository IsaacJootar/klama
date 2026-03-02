<?php

namespace App\Livewire\Reservations;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Room;
use App\Models\Roomallocation;
use App\Models\Reservation;
use App\Models\SwapRoom;
use App\Models\Roomcategory;
use App\Models\HotelExpense;
use App\Models\HotelIncome;
use Illuminate\Support\Carbon;

#[Title('Reservation Dashboard')]
class ReservationsDashboard extends Component
{
    public $total_rooms = 0;
    public $available_rooms = 0;
    public $total_reservations = 0;
    public $reservations_today = 0;
    public $reservations_this_week = 0;
    public $reservations_this_month = 0;
    public $occupancy_rate = 0;
    public $occupied_today = 0;
    public $room_categories = 0;
    public $revenue_today = 0;
    public $revenue_this_week = 0;
    public $revenue_this_month = 0;
    public $expenses_today = 0;
    public $expenses_this_week = 0;
    public $expenses_this_month = 0;
    public $profit_today = 0;
    public $profit_this_week = 0;
    public $profit_this_month = 0;
    public $recent_reservations = [];
    public $weekly_data = [];
    public $monthly_data = [];

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

        // Reservations Today
        $this->reservations_today = Reservation::whereDate('created_at', $today)->count();

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

        // Revenue Calculations (including HotelIncome for Reservations section)
        $this->revenue_today = Reservation::whereDate('created_at', $today)->sum('total_amount') +
                              SwapRoom::whereDate('created_at', $today)->sum('swap_value') +
                              HotelIncome::whereDate('income_date', $today)
                                         ->where('section', 'Reservations')
                                         ->sum('amount');
        $this->revenue_this_week = Reservation::whereBetween('created_at', [
            Carbon::today()->startOfWeek(),
            Carbon::today()->endOfWeek()
        ])->sum('total_amount') +
                                   SwapRoom::whereBetween('created_at', [
                                       Carbon::today()->startOfWeek(),
                                       Carbon::today()->endOfWeek()
                                   ])->sum('swap_value') +
                                   HotelIncome::whereBetween('income_date', [
                                       Carbon::today()->startOfWeek()->format('Y-m-d'),
                                       Carbon::today()->endOfWeek()->format('Y-m-d')
                                   ])
                                   ->where('section', 'Reservations')
                                   ->sum('amount');
        $this->revenue_this_month = Reservation::whereMonth('created_at', Carbon::today()->month)
            ->whereYear('created_at', Carbon::today()->year)
            ->sum('total_amount') +
                                    SwapRoom::whereMonth('created_at', Carbon::today()->month)
                                            ->whereYear('created_at', Carbon::today()->year)
                                            ->sum('swap_value') +
                                    HotelIncome::whereMonth('income_date', Carbon::today()->month)
                                               ->whereYear('income_date', Carbon::today()->year)
                                               ->where('section', 'Reservations')
                                               ->sum('amount');

        // Expenses Calculations
        $this->expenses_today = HotelExpense::where('expense_date', $today)
            ->where('section', 'Reservations')
            ->sum('amount');
        $this->expenses_this_week = HotelExpense::whereBetween('expense_date', [
            Carbon::today()->startOfWeek()->format('Y-m-d'),
            Carbon::today()->endOfWeek()->format('Y-m-d')
        ])
            ->where('section', 'Reservations')
            ->sum('amount');
        $this->expenses_this_month = HotelExpense::whereMonth('expense_date', Carbon::today()->month)
            ->whereYear('expense_date', Carbon::today()->year)
            ->where('section', 'Reservations')
            ->sum('amount');

        // Profit Calculations
        $this->profit_today = $this->revenue_today - $this->expenses_today;
        $this->profit_this_week = $this->revenue_this_week - $this->expenses_this_week;
        $this->profit_this_month = $this->revenue_this_month - $this->expenses_this_month;

        // Recent Reservations
        $this->recent_reservations = Reservation::select('fullname', 'reservation_id', 'checkin', 'checkout')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Weekly Data for Chart
        $this->weekly_data = Reservation::selectRaw('DATE(created_at) as date, COUNT(*) as reservations')
            ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()])
            ->groupBy('date')
            ->get();

        // Monthly Data for Chart (updated to include HotelIncome)
        $this->monthly_data = Reservation::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_amount) as revenue')
            ->whereBetween('created_at', [Carbon::today()->subMonths(11), Carbon::today()])
            ->groupBy('month')
            ->get()
            ->map(function ($item) {
                $item->revenue += SwapRoom::whereRaw('DATE_FORMAT(created_at, "%Y-%m") = ?', [$item->month])
                                         ->sum('swap_value') +
                                  HotelIncome::whereRaw('DATE_FORMAT(income_date, "%Y-%m") = ?', [$item->month])
                                             ->where('section', 'Reservations')
                                             ->sum('amount');
                $item->expenses = HotelExpense::whereRaw('DATE_FORMAT(expense_date, "%Y-%m") = ?', [$item->month])
                    ->where('section', 'Reservations')
                    ->sum('amount');
                return $item;
            });
    }

    public function render()
    {
        return view('livewire.reservations.reservations-dashboard')
            ->layout('layouts.reservations');
    }
}