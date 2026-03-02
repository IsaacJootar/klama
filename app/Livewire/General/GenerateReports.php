<?php

namespace App\Livewire\General;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Reservation;
use App\Models\SwapRoom;
use App\Models\HotelExpense;
use App\Models\HotelIncome;
use App\Models\FnbOrder;
use App\Models\HouseLaundryRequest;
use App\Models\Room;
use App\Models\Roomallocation;
use App\Models\Roomcategory;
use App\Models\FnbMenu;
use App\Models\KitchenStoreInventory;
use App\Models\KitchenStoreItem;
use App\Models\KitchenStoreLog;
use App\Models\SalesCoupon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

#[Title('Report Generator')]
class GenerateReports extends Component
{
    public $report_type = '';
    public $date_range = 'last_30_days';
    public $start_date = '';
    public $end_date = '';
    public $section = 'all';
    public $report_data = [];
    public $report_title = '';
    public $active_tab = 'financial';

    public $date_range_options = [
        'today' => 'Today',
        'last_7_days' => 'Last 7 Days',
        'last_30_days' => 'Last 30 Days',
        'this_month' => 'This Month',
        'last_month' => 'Last Month',
        'this_year' => 'This Year',
        'custom' => 'Custom Range',
    ];

    public $report_types = [
        'financial' => [
            'revenue_by_section' => 'Revenue by Section',
            'expense_by_section' => 'Expense by Section',
            'profit_by_section' => 'Profit by Section',
            'daily_transaction_summary' => 'Daily Transaction Summary',
        ],
        'operational' => [
            'occupancy_analysis' => 'Occupancy Analysis',
            'guest_activity' => 'Guest Activity',
            'room_category_performance' => 'Room Category Performance',
            'Kitchen_And_Restaurant_menu_performance' => 'Kitchen And Restaurant Performance',
            'kitchen_inventory_status' => 'Kitchen Inventory Status',
        ],
    ];

    public $sections = [
        'all' => 'All Sections',
        'Reservations' => 'Reservations',
        'Kitchen_And_Restaurant' => 'Kitchen & Restaurant',
        'Laundry' => 'House Keeping & Laundry',
        'General' => 'General Manager\'s Office',
    ];

    public function generateReport()
    {
        $this->report_data = [];
        $startDate = $this->getStartDate();
        $endDate = $this->getEndDate();
        $cacheKey = "report_{$this->report_type}_{$startDate}_{$endDate}_{$this->section}";

        // Cache report data for 10 minutes
        $this->report_data = Cache::remember($cacheKey, 600, function () use ($startDate, $endDate) {
            switch ($this->report_type) {
                case 'revenue_by_section':
                    $this->report_title = 'Revenue by Section';
                    return $this->getRevenueBySection($startDate, $endDate);
                case 'expense_by_section':
                    $this->report_title = 'Expense by Section';
                    return $this->getExpenseBySection($startDate, $endDate);
                case 'profit_by_section':
                    $this->report_title = 'Profit by Section';
                    return $this->getProfitBySection($startDate, $endDate);
                case 'occupancy_analysis':
                    $this->report_title = 'Occupancy Analysis';
                    return $this->getOccupancyAnalysis($startDate, $endDate);
                case 'guest_activity':
                    $this->report_title = 'Guest Activity';
                    return $this->getGuestActivity($startDate, $endDate);
                case 'room_category_performance':
                    $this->report_title = 'Room Category Performance';
                    return $this->getRoomCategoryPerformance($startDate, $endDate);
                case 'daily_transaction_summary':
                    $this->report_title = 'Daily Transaction Summary';
                    return $this->getDailyTransactionSummary($startDate, $endDate);
                case 'Kitchen_And_Restaurant_menu_performance':
                    $this->report_title = 'Kitchen And Restaurant Performance';
                    return $this->getFnbMenuPerformance($startDate, $endDate);
                case 'kitchen_inventory_status':
                    $this->report_title = 'Kitchen Inventory Status';
                    return $this->getKitchenInventoryStatus($startDate, $endDate);
                default:
                    $this->report_title = '';
                    return [];
            }
        });

        // Store report data in session for preview
        session([
            'report_type' => $this->report_type,
            'report_title' => $this->report_title,
            'report_data' => $this->report_data,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'active_tab' => $this->active_tab,
        ]);
    }

    public function setActiveTab($tab)
    {
        $this->active_tab = $tab;
        $this->report_type = '';
        $this->report_data = [];
        $this->report_title = '';
    }

    private function getStartDate()
    {
        switch ($this->date_range) {
            case 'today':
                return Carbon::today()->format('Y-m-d');
            case 'last_7_days':
                return Carbon::today()->subDays(6)->format('Y-m-d');
            case 'last_30_days':
                return Carbon::today()->subDays(29)->format('Y-m-d');
            case 'this_month':
                return Carbon::today()->startOfMonth()->format('Y-m-d');
            case 'last_month':
                return Carbon::today()->subMonth()->startOfMonth()->format('Y-m-d');
            case 'this_year':
                return Carbon::today()->startOfYear()->format('Y-m-d');
            case 'custom':
                return $this->start_date ?: Carbon::today()->subDays(29)->format('Y-m-d');
            default:
                return Carbon::today()->subDays(29)->format('Y-m-d');
        }
    }

    private function getEndDate()
    {
        return $this->date_range === 'custom' && $this->end_date
            ? $this->end_date
            : Carbon::today()->format('Y-m-d');
    }

    private function getRevenueBySection($startDate, $endDate)
    {
        $data = [];
        $sections = $this->section === 'all' ? array_keys(array_diff_key($this->sections, ['all' => ''])) : [$this->section];

        foreach ($sections as $section) {
            $revenue = 0;
            if ($section === 'Reservations') {
                $revenue += Reservation::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount');
                $revenue += SwapRoom::whereBetween('created_at', [$startDate, $endDate])->sum('swap_value');
            } elseif ($section === 'Kitchen_And_Restaurant') {
                $revenue += FnbOrder::whereBetween('order_date', [$startDate, $endDate])->sum('price');
            } elseif ($section === 'Laundry') {
                $revenue += HouseLaundryRequest::whereBetween('created_at', [$startDate, $endDate])->sum('amount_received');
            } elseif ($section === 'General') {
                $revenue += HotelIncome::whereBetween('income_date', [$startDate, $endDate])
                                      ->where('section', $section)
                                      ->sum('amount');
            }
            // Adjust for coupons
            $couponDiscounts = SalesCoupon::whereBetween('updated_at', [$startDate, $endDate])
                                         ->where('usage_count', '>', 0)
                                         ->sum('discount_value');
            $data[$section] = [
                'gross_revenue' => $revenue,
                'coupon_discounts' => $section === 'Reservations' ? $couponDiscounts : 0,
                'net_revenue' => $revenue - ($section === 'Reservations' ? $couponDiscounts : 0),
            ];
        }
        return $data;
    }

    private function getExpenseBySection($startDate, $endDate)
    {
        $data = [];
        $sections = $this->section === 'all' ? array_keys(array_diff_key($this->sections, ['all' => ''])) : [$this->section];

        foreach ($sections as $section) {
            $data[$section] = HotelExpense::whereBetween('expense_date', [$startDate, $endDate])
                                         ->where('section', $section)
                                         ->sum('amount');
        }
        return $data;
    }

    private function getProfitBySection($startDate, $endDate)
    {
        $revenues = $this->getRevenueBySection($startDate, $endDate);
        $expenses = $this->getExpenseBySection($startDate, $endDate);
        $data = [];

        foreach ($revenues as $section => $revenueData) {
            $data[$section] = [
                'gross_revenue' => $revenueData['gross_revenue'],
                'coupon_discounts' => $revenueData['coupon_discounts'],
                'net_revenue' => $revenueData['net_revenue'],
                'expense' => $expenses[$section] ?? 0,
                'profit' => $revenueData['net_revenue'] - ($expenses[$section] ?? 0),
            ];
        }
        return $data;
    }

    private function getOccupancyAnalysis($startDate, $endDate)
    {
        // Only process for 'all' or 'Reservations' sections
        if (!in_array($this->section, ['all', 'Reservations'])) {
            return [
                'total_rooms' => 0,
                'occupancy_rate' => 0,
                'occupied_days' => 0,
                'total_possible_days' => 0,
                'category_breakdown' => [],
            ];
        }

        // Total number of rooms
        $total_rooms = Room::count();

        // Calculate occupied days using resv_reservations
        $occupied_days = Reservation::where('checkin', '<=', $endDate)
            ->where('checkout', '>=', $startDate)
            ->where('checkin_status', 'Checkedin')
            ->where('status', 'Open')
            ->select(DB::raw('SUM(DATEDIFF(LEAST(checkout, "' . $endDate . '"), GREATEST(checkin, "' . $startDate . '"))) as occupied_days'))
            ->value('occupied_days') ?? 0;

        // Calculate days in the period
        $days_in_period = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;

        // Calculate total possible room-days
        $total_possible_days = $total_rooms * $days_in_period;

        // Calculate occupancy rate
        $occupancy_rate = $total_possible_days > 0 ? round(($occupied_days / $total_possible_days) * 100, 2) : 0;

        // Category breakdown using resv_reservations
        $category_breakdown = Reservation::query()
            ->select('resv_room_categories.category', DB::raw('COUNT(*) as allocations_count'))
            ->join('resv_room_categories', 'resv_reservations.category_id', '=', 'resv_room_categories.id')
            ->where('resv_reservations.checkin', '<=', $endDate)
            ->where('resv_reservations.checkout', '>=', $startDate)
            ->where('resv_reservations.checkin_status', 'Checkedin')
            ->where('resv_reservations.status', 'Open')
            ->groupBy('resv_room_categories.category')
            ->get()
            ->map(function ($item) {
                return [
                    'category' => $item->category,
                    'allocations' => $item->allocations_count,
                ];
            })
            ->toArray();

        return [
            'total_rooms' => $total_rooms,
            'occupancy_rate' => $occupancy_rate,
            'occupied_days' => $occupied_days,
            'total_possible_days' => $total_possible_days,
            'category_breakdown' => $category_breakdown,
        ];
    }

    private function getGuestActivity($startDate, $endDate)
    {
        return Reservation::whereBetween('created_at', [$startDate, $endDate])
            ->select('fullname', 'reservation_id', 'checkin', 'checkout', 'total_amount')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($reservation) {
                return [
                    'fullname' => $reservation->fullname,
                    'reservation_id' => $reservation->reservation_id,
                    'checkin' => $reservation->checkin,
                    'checkout' => $reservation->checkout,
                    'total_amount' => $reservation->total_amount,
                    'fnb_orders' => FnbOrder::where('user_id', $reservation->user_id)
                                           ->whereBetween('order_date', [$reservation->checkin, $reservation->checkout])
                                           ->sum('price'),
                ];
            })
            ->toArray();
    }

    private function getRoomCategoryPerformance($startDate, $endDate)
    {
        $data = [];

        // Get all categories
        $categories = Roomcategory::all();

        foreach ($categories as $category) {
            // Count allocations and revenue from resv_reservations
            $reservation_data = Reservation::query()
                ->select(DB::raw('COUNT(*) as allocations_count'), DB::raw('SUM(total_amount) as total_revenue'))
                ->join('resv_room_categories', 'resv_reservations.category_id', '=', 'resv_room_categories.id')
                ->where('resv_room_categories.id', $category->id)
                ->where('resv_reservations.checkin', '<=', $endDate)
                ->where('resv_reservations.checkout', '>=', $startDate)
                ->where('resv_reservations.checkin_status', 'Checkedin')
                ->where('resv_reservations.status', 'Open')
                ->first();

            $allocations = $reservation_data->allocations_count ?? 0;
            $revenue = $reservation_data->total_revenue ?? 0;

            $data[$category->category] = [
                'allocations' => $allocations,
                'revenue' => $revenue,
                'average_revenue_per_allocation' => $allocations > 0 ? round($revenue / $allocations, 2) : 0,
            ];
        }

        return $data;
    }

    private function getDailyTransactionSummary($startDate, $endDate)
    {
        $data = [];
        $currentDate = Carbon::parse($startDate);
        while ($currentDate <= Carbon::parse($endDate)) {
            $date = $currentDate->format('Y-m-d');
            $data[$date] = [
                'reservations' => Reservation::whereDate('created_at', $date)->count(),
                'fnb_orders' => FnbOrder::whereDate('order_date', $date)->count(),
                'laundry_requests' => HouseLaundryRequest::whereDate('created_at', $date)->count(),
                'reservation_revenue' => Reservation::whereDate('created_at', $date)->sum('total_amount') +
                                       SwapRoom::whereDate('created_at', $date)->sum('swap_value'),
                'fnb_revenue' => FnbOrder::whereDate('order_date', $date)->sum('price'),
                'laundry_revenue' => HouseLaundryRequest::whereDate('created_at', $date)->sum('amount_received'),
                'general_revenue' => HotelIncome::whereDate('income_date', $date)->sum('amount'),
                'expenses' => HotelExpense::whereDate('expense_date', $date)->sum('amount'),
            ];
            $currentDate->addDay();
        }
        return $data;
    }

    private function getFnbMenuPerformance($startDate, $endDate)
    {
        // Only process for 'all' or 'Kitchen_And_Restaurant' sections
        if (!in_array($this->section, ['all', 'Kitchen_And_Restaurant'])) {
            return [];
        }

        $menuItems = FnbMenu::all();
        $data = [];

        foreach ($menuItems as $menu) {
            $orders = FnbOrder::where('order_name', $menu->name)
                             ->whereBetween(DB::raw('CAST(order_date AS DATE)'), [$startDate, $endDate])
                             ->select(DB::raw('SUM(CAST(quantity AS UNSIGNED)) as total_quantity'), DB::raw('SUM(price) as total_revenue'))
                             ->first();
            $data[$menu->name] = [
                'category' => $menu->category,
                'unit_price' => $menu->price,
                'total_quantity' => $orders->total_quantity ?? 0,
                'total_revenue' => $orders->total_revenue ?? 0,
            ];
        }

        // Filter out items with zero quantity
        return array_filter($data, function ($item) { return $item['total_quantity'] > 0; });
        // For debugging, return all items:
        // return $data;
    }

    private function getKitchenInventoryStatus($startDate, $endDate)
    {
        $inventory = KitchenStoreInventory::with(['item.category'])->get();
        $data = [];

        foreach ($inventory as $inv) {
            $logs = KitchenStoreLog::where('item_id', $inv->item_id)
                                      ->whereBetween('timestamp', [$startDate, $endDate])
                                      ->select(
                                          DB::raw('SUM(CASE WHEN action = "add" THEN quantity_changed ELSE 0 END) as added'),
                                          DB::raw('SUM(CASE WHEN action = "deduct" THEN quantity_changed ELSE 0 END) as deducted')
                                      )
                                      ->first();
            $data[$inv->item->item] = [
                'category' => $inv->item->category->category ?? 'Uncategorized',
                'measurement_tag' => $inv->item->measurement_tag,
                'current_quantity' => $inv->quantity,
                'added' => $logs->added ?? 0,
                'deducted' => $logs->deducted ?? 0,
            ];
        }
        return $data;
    }

    public function exportCsv()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"report_{$this->report_type}_" . now()->format('Ymd') . ".csv\"",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            if ($this->report_type === 'revenue_by_section') {
                fputcsv($file, ['Section', 'Gross Revenue', 'Coupon Discounts', 'Net Revenue']);
                foreach ($this->report_data as $section => $data) {
                    fputcsv($file, [$section, $data['gross_revenue'], $data['coupon_discounts'], $data['net_revenue']]);
                }
            } elseif ($this->report_type === 'Kitchen_And_Restaurant_menu_performance') {
                fputcsv($file, ['Menu Item', 'Category', 'Unit Price', 'Total Quantity', 'Total Revenue']);
                foreach ($this->report_data as $menuItem => $data) {
                    fputcsv($file, [$menuItem, $data['category'], $data['unit_price'], $data['total_quantity'], $data['total_revenue']]);
                }
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        return view('livewire.general.generate-reports')
            ->layout('layouts.general');
    }
}