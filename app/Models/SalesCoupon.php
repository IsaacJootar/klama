<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesCoupon extends Model
{
    protected $table = 'sales_coupons';
    protected $fillable = [
        'code', 'discount_value', 'start_date', 'end_date', 'usage_count'
    ];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}