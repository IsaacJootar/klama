<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FnbOrder extends Model
{
    //

    use HasFactory;

    protected $table = 'fnb_orders';

    protected $fillable = [
        'order_code',
        'order_name',
        'order_date',
        'category',
        'quantity',
        'user_id',
        'price',
    ];
}
