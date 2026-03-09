<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = "resv_reservations";
    protected $fillable = [
        'user_id',
        'room_id',
        'category_id',
        'reservation_id',
        'unit_price',
        'total_amount',
        'coupon_code',
         'nor',
         'medium',
         'payment_status',
         'fullname',
         'address',
         'requests',
         'phone',
         'email',
         'checkin',
         'checkout',
         'status',
         'state',
         'flag',
         'bank_id', 
         'checkin_status', 'checkin_type', 'early_checkin_fee',
        'checkout_status', 'checkout_type', 'late_checkout_fee', 'confirmation_note'
    ];
}
