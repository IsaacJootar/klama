<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SwapRoom extends Model
{
    protected $table = "resv_swap_room";
    protected $fillable = [
        'user_id',
        'swap_from_id',
        'swap_to_id',
        'from_category_id',
        'to_category_id',
        'from_reservation_id',
        'to_reservation_id',
        'customer',
        'to_customer',
        'to_phone',
        'to_email',
        'swap_type',
        'swap_value',
    ];
}
