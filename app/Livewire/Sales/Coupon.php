<?php

namespace App\Livewire\Sales;

use Livewire\Component;
use App\Models\SalesCoupon;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Title('Sales | Coupon Management')]
class Coupon extends Component
{
    public $coupons;
    public $numCoupons = 1; // Number of coupons to generate
    public $couponCode; // For editing single coupon
    public $discountValue = 0;
    public $startDate;
    public $endDate;
    public $coupon_id; // For editing existing coupons

    public $modal_flag = false; // Flag for showing edit modal
    public $modal_title = 'Create New Coupons';

    protected $rules = [
        'numCoupons'    => 'required|integer|min:1|max:100',
        'discountValue' => 'required|numeric|min:0',
        'startDate'     => 'required|date|after_or_equal:today',
        'endDate'       => 'required|date|after_or_equal:startDate',
    ];

    protected $editRules = [
        'couponCode'    => 'required|string|size:6|regex:/^[A-Z0-9]{6}$/|unique:sales_coupons,code',
        'discountValue' => 'required|numeric|min:0',
        'startDate'     => 'required|date|after_or_equal:today',
        'endDate'       => 'required|date|after_or_equal:startDate',
    ];

    public function mount()
    {
        $this->startDate = Carbon::today()->format('Y-m-d');
        $this->endDate = Carbon::today()->addDays(30)->format('Y-m-d'); // Default, user can change
    }

    public function render()
    {
        $this->coupons = SalesCoupon::all();
        return view('livewire.sales.coupon')->layout('layouts.sales');
    }

    public function exit()
    {
        $this->reset([
            'numCoupons', 'couponCode', 'discountValue', 'startDate', 'endDate',
            'coupon_id', 'modal_flag', 'modal_title'
        ]);
        $this->numCoupons = 1;
        $this->startDate = Carbon::today()->format('Y-m-d');
        $this->endDate = Carbon::today()->addDays(30)->format('Y-m-d');
        $this->modal_title = 'Create New Coupons';
    }

    public function generateCouponCode()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        while (SalesCoupon::where('code', $code)->exists()) {
            $code = '';
            for ($i = 0; $i < 6; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
        }
        return $code;
    }

    public function save()
    {
        $this->validate($this->coupon_id ? $this->editRules : $this->rules);

        if ($this->coupon_id) {
            // Edit single coupon
            SalesCoupon::updateOrCreate(
                ['id' => $this->coupon_id],
                [
                    'code'           => $this->couponCode,
                    'discount_value' => $this->discountValue,
                    'start_date'     => $this->startDate,
                    'end_date'       => $this->endDate,
                    'usage_count'    => SalesCoupon::find($this->coupon_id)->usage_count,
                ]
            );
        } else {
            // Create multiple coupons
            for ($i = 0; $i < $this->numCoupons; $i++) {
                SalesCoupon::create([
                    'code'           => $this->generateCouponCode(),
                    'discount_value' => $this->discountValue,
                    'start_date'     => $this->startDate,
                    'end_date'       => $this->endDate,
                    'usage_count'    => 0,
                ]);
            }
        }

        toastr()->info($this->coupon_id ? 'Coupon updated successfully!' : $this->numCoupons . ' coupon(s) created successfully!');
        $this->exit();
    }

    public function edit($id)
    {
        $coupon = SalesCoupon::findOrFail($id);
        $this->coupon_id = $coupon->id;
        $this->couponCode = $coupon->code;
        $this->discountValue = $coupon->discount_value;
        $this->startDate = $coupon->start_date->format('Y-m-d');
        $this->endDate = $coupon->end_date->format('Y-m-d');
        $this->numCoupons = 1; // Editing is for single coupon
        $this->modal_flag = true;
        $this->modal_title = 'Update Coupon';
    }

    public function delete($id)
    {
        SalesCoupon::findOrFail($id)->delete();
        toastr()->info('Coupon deleted successfully!');
    }
}