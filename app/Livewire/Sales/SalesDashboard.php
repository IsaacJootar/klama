<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\SalesCoupon;
use Carbon\Carbon;

#[Title('Sales | Dashboard')]
class SalesDashboard extends Component
{
    public $total_coupons = 0;
    public $active_coupons = 0;
    public $used_coupons = 0;
    public $expired_coupons = 0;
    public $coupon_trends = [];

    public function mount()
    {
        // Initialize coupon-related metrics
        $this->total_coupons = SalesCoupon::count();
        $this->used_coupons = SalesCoupon::where('usage_count', '>=', 1)->count();
        $this->expired_coupons = SalesCoupon::where('end_date', '<', Carbon::today())->count();
        $this->active_coupons = SalesCoupon::where('usage_count', 0)
            ->where('end_date', '>=', Carbon::today())
            ->count();
        $this->coupon_trends = [
            ['date' => Carbon::today()->subDays(6)->format('Y-m-d'), 'usage' => 50],
            ['date' => Carbon::today()->subDays(5)->format('Y-m-d'), 'usage' => 70],
            ['date' => Carbon::today()->subDays(4)->format('Y-m-d'), 'usage' => 60],
            ['date' => Carbon::today()->subDays(3)->format('Y-m-d'), 'usage' => 90],
            ['date' => Carbon::today()->subDays(2)->format('Y-m-d'), 'usage' => 80],
            ['date' => Carbon::today()->subDays(1)->format('Y-m-d'), 'usage' => 100],
            ['date' => Carbon::today()->format('Y-m-d'), 'usage' => 120],
        ];
    }

    public function render()
    {
        return view('livewire.sales.sales-dashboard')->layout('layouts.sales', [
            'total_coupons' => $this->total_coupons,
            'active_coupons' => $this->active_coupons,
            'used_coupons' => $this->used_coupons,
            'expired_coupons' => $this->expired_coupons,
            'coupon_trends' => $this->coupon_trends,
        ]);
    }
}