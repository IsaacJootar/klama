<?php

namespace App\Livewire\Fnb;

use App\Models\FnbMenu;
use App\Models\FnbOrder;
use App\Models\KitchenStoreItems;
use App\Models\KitchenStoreCategories;
use App\Models\KitchenStoreLogs;
use App\Models\FnbExpCategory;
use App\Models\HotelExpense;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

#[Title('Kitchen & Restaurant | Dashboard')]
class Dashboard extends Component
{    
    // Order Statistics
    public $orders_today, $total_orders;
    public $orders_this_week, $orders_this_month;
    
    // Revenue Statistics
    public $today_revenue, $weekly_revenue, $monthly_revenue, $total_revenue;
    public $average_order_value;
    
    // Expense Statistics
    public $expenses_today, $weekly_expenses, $monthly_expenses, $total_expenses;
    public $expense_categories_count;
    
    // Store Statistics
    public $total_store_items, $total_categories, $low_stock_items, $out_of_stock_items;
    public $recent_store_activity;
    
    // Menu Statistics
    public $total_menu_items, $available_menu_items, $unavailable_menu_items;
    public $top_categories;
    
    // Profit and Loss Statistics
    public $today_profit, $weekly_profit, $monthly_profit;
    
    // Performance Metrics
    public $order_completion_rate, $revenue_growth, $expense_growth;
    
    // Charts Data
    public $weekly_orders_chart, $revenue_chart, $category_sales_chart, $weekly_expenses_chart;

    public function mount()
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek(); // Monday
        $weekEnd = Carbon::now()->endOfWeek(); // Sunday
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        
        $this->loadOrderStatistics($today, $weekStart, $weekEnd, $monthStart, $monthEnd);
        $this->loadRevenueStatistics($today, $weekStart, $weekEnd, $monthStart, $monthEnd);
        $this->loadExpenseStatistics($today, $weekStart, $weekEnd, $monthStart, $monthEnd);
        $this->loadStoreStatistics($today);
        $this->loadMenuStatistics();
        $this->loadProfitLossStatistics();
        $this->loadPerformanceMetrics($monthStart, $monthEnd);
        $this->loadChartData($weekStart, $monthStart);
    }

    private function loadOrderStatistics($today, $weekStart, $weekEnd, $monthStart, $monthEnd)
    {
        // Daily Orders
        $this->orders_today = FnbOrder::whereDate('created_at', $today)->count();
        
        // Weekly Orders (Monday to Sunday of current week)
        $this->orders_this_week = FnbOrder::whereBetween('created_at', [
            $weekStart->startOfDay(), 
            $weekEnd->endOfDay()
        ])->count();
        
        // Monthly Orders (1st to last day of current month)
        $this->orders_this_month = FnbOrder::whereBetween('created_at', [
            $monthStart->startOfDay(), 
            $monthEnd->endOfDay()
        ])->count();
        
        // Total Orders
        $this->total_orders = FnbOrder::count();
    }

    private function loadRevenueStatistics($today, $weekStart, $weekEnd, $monthStart, $monthEnd)
    {
        // Daily Revenue
        $this->today_revenue = (float) FnbOrder::whereDate('created_at', $today)
            ->sum('price') ?? 0;
            
        // Weekly Revenue (Monday to Sunday of current week)
        $this->weekly_revenue = (float) FnbOrder::whereBetween('created_at', [
            $weekStart->startOfDay(), 
            $weekEnd->endOfDay()
        ])->sum('price') ?? 0;
            
        // Monthly Revenue (1st to last day of current month)
        $this->monthly_revenue = (float) FnbOrder::whereBetween('created_at', [
            $monthStart->startOfDay(), 
            $monthEnd->endOfDay()
        ])->sum('price') ?? 0;
            
        // Total Revenue
        $this->total_revenue = (float) FnbOrder::sum('price') ?? 0;
        
        // Average Order Value
        $total_orders_count = FnbOrder::count();
        $this->average_order_value = $total_orders_count > 0 ? 
            round($this->total_revenue / $total_orders_count, 2) : 0;
    }

    private function loadExpenseStatistics($today, $weekStart, $weekEnd, $monthStart, $monthEnd)
    {
        // Daily Expenses
        $this->expenses_today = (float) HotelExpense::where('section', 'Kitchen_And_Restaurant')
            ->whereDate('expense_date', $today)
            ->sum('amount') ?? 0;
            
        // Weekly Expenses (Monday to Sunday of current week)
        $this->weekly_expenses = (float) HotelExpense::where('section', 'Kitchen_And_Restaurant')
            ->whereBetween('expense_date', [
                $weekStart->format('Y-m-d'), 
                $weekEnd->format('Y-m-d')
            ])
            ->sum('amount') ?? 0;
            
        // Monthly Expenses (1st to last day of current month)
        $this->monthly_expenses = (float) HotelExpense::where('section', 'Kitchen_And_Restaurant')
            ->whereBetween('expense_date', [
                $monthStart->format('Y-m-d'), 
                $monthEnd->format('Y-m-d')
            ])
            ->sum('amount') ?? 0;
            
        // Total Expenses
        $this->total_expenses = (float) HotelExpense::where('section', 'Kitchen_And_Restaurant')
            ->sum('amount') ?? 0;
            
        // Expense Categories Count
        $this->expense_categories_count = FnbExpCategory::count();
    }

    private function loadStoreStatistics($today)
    {
        // Total Store Items
        $this->total_store_items = KitchenStoreItems::count();
        
        // Total Categories
        $this->total_categories = KitchenStoreCategories::count();
        
        // Low Stock Items (you can implement quantity logic later)
        $this->low_stock_items = 0;
        $this->out_of_stock_items = 0;
        
        // Recent Store Activity
        $this->recent_store_activity = KitchenStoreLogs::whereDate('timestamp', $today)->count();
    }

    private function loadMenuStatistics()
    {
        // Total Menu Items
        $this->total_menu_items = FnbMenu::count();
        
        // Available vs Unavailable
        $this->available_menu_items = FnbMenu::where('available', true)->count();
        $this->unavailable_menu_items = FnbMenu::where('available', false)->count();
        
        // Top Categories by menu count
        $this->top_categories = FnbMenu::select('category')
            ->selectRaw('COUNT(*) as menu_count')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->orderByDesc('menu_count')
            ->limit(5)
            ->get();
    }

    private function loadProfitLossStatistics()
    {
        // Daily Profit/Loss
        $this->today_profit = round($this->today_revenue - $this->expenses_today, 2);
        
        // Weekly Profit/Loss
        $this->weekly_profit = round($this->weekly_revenue - $this->weekly_expenses, 2);
        
        // Monthly Profit/Loss
        $this->monthly_profit = round($this->monthly_revenue - $this->monthly_expenses, 2);
    }

    private function loadPerformanceMetrics($monthStart, $monthEnd)
    {
        // Order Completion Rate (assuming all orders are completed)
        $this->order_completion_rate = 100;
            
        // Revenue Growth (comparing this month to last month)
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        
        $lastMonthRevenue = (float) FnbOrder::whereBetween('created_at', [
            $lastMonthStart->startOfDay(), 
            $lastMonthEnd->endOfDay()
        ])->sum('price') ?? 0;
            
        if ($lastMonthRevenue > 0) {
            $this->revenue_growth = round((($this->monthly_revenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 2);
        } else {
            $this->revenue_growth = $this->monthly_revenue > 0 ? 100 : 0;
        }
        
        // Expense Growth (comparing this month to last month)
        $lastMonthExpenses = (float) HotelExpense::where('section', 'Kitchen_And_Restaurant')
            ->whereBetween('expense_date', [
                $lastMonthStart->format('Y-m-d'), 
                $lastMonthEnd->format('Y-m-d')
            ])
            ->sum('amount') ?? 0;
            
        if ($lastMonthExpenses > 0) {
            $this->expense_growth = round((($this->monthly_expenses - $lastMonthExpenses) / $lastMonthExpenses) * 100, 2);
        } else {
            $this->expense_growth = $this->monthly_expenses > 0 ? 100 : 0;
        }
    }

    private function loadChartData($weekStart, $monthStart)
    {
        // Weekly Orders Chart Data (last 7 days)
        $this->weekly_orders_chart = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo);
            return [
                'date' => $date->format('M d'),
                'orders' => FnbOrder::whereDate('created_at', $date)->count(),
                'revenue' => (float) FnbOrder::whereDate('created_at', $date)->sum('price') ?? 0
            ];
        });

        // Weekly Expenses Chart Data (last 7 days)
        $this->weekly_expenses_chart = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::now()->subDays($daysAgo);
            return [
                'date' => $date->format('M d'),
                'expenses' => (float) HotelExpense::where('section', 'Kitchen_And_Restaurant')
                    ->whereDate('expense_date', $date->format('Y-m-d'))
                    ->sum('amount') ?? 0
            ];
        });

        // Monthly Revenue Chart (last 12 months)
        $this->revenue_chart = collect(range(11, 0))->map(function ($monthsAgo) {
            $date = Carbon::now()->subMonths($monthsAgo);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();
            
            return [
                'month' => $date->format('M Y'),
                'revenue' => (float) FnbOrder::whereBetween('created_at', [
                    $monthStart->startOfDay(), 
                    $monthEnd->endOfDay()
                ])->sum('price') ?? 0
            ];
        });

        // Category Sales Chart
        $this->category_sales_chart = FnbMenu::select('category')
            ->selectRaw('COUNT(*) as count')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->get()
            ->map(function ($item) {
                return [
                    'category' => $item->category,
                    'count' => $item->count
                ];
            });
    }

    public function render()
    {
        return view('livewire.fnb.dashboard', [
            // Order Stats
            'orders_today' => $this->orders_today,
            'orders_this_week' => $this->orders_this_week,
            'orders_this_month' => $this->orders_this_month,
            'total_orders' => $this->total_orders,
            
            // Revenue Stats
            'today_revenue' => $this->today_revenue,
            'weekly_revenue' => $this->weekly_revenue,
            'monthly_revenue' => $this->monthly_revenue,
            'total_revenue' => $this->total_revenue,
            'average_order_value' => $this->average_order_value,
            
            // Expense Stats
            'expenses_today' => $this->expenses_today,
            'weekly_expenses' => $this->weekly_expenses,
            'monthly_expenses' => $this->monthly_expenses,
            'total_expenses' => $this->total_expenses,
            'expense_categories_count' => $this->expense_categories_count,
            
            // Store Stats
            'total_store_items' => $this->total_store_items,
            'total_categories' => $this->total_categories,
            'low_stock_items' => $this->low_stock_items,
            'out_of_stock_items' => $this->out_of_stock_items,
            'recent_store_activity' => $this->recent_store_activity,
            
            // Menu Stats
            'total_menu_items' => $this->total_menu_items,
            'available_menu_items' => $this->available_menu_items,
            'unavailable_menu_items' => $this->unavailable_menu_items,
            'top_categories' => $this->top_categories,
            
            // Profit and Loss Stats
            'today_profit' => $this->today_profit,
            'weekly_profit' => $this->weekly_profit,
            'monthly_profit' => $this->monthly_profit,
            
            // Performance Metrics
            'order_completion_rate' => $this->order_completion_rate,
            'revenue_growth' => $this->revenue_growth,
            'expense_growth' => $this->expense_growth,
            
            // Chart Data
            'weekly_orders_chart' => $this->weekly_orders_chart,
            'revenue_chart' => $this->revenue_chart,
            'category_sales_chart' => $this->category_sales_chart,
            'weekly_expenses_chart' => $this->weekly_expenses_chart,
        ])->layout('layouts.fnb');
    }
}