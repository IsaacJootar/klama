<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FnbOrderItem extends Model
{
    //
    use HasFactory;

    protected $table = 'fnb_order_items';

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'subtotal',
    ];
}
