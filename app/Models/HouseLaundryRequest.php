<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseLaundryRequest extends Model
{
    use HasFactory;

    protected $table = 'house_laundry_requests';

    protected $fillable = [
        'guest_name',
        'room_id',
        'items',
        'total_cost',
        'status',
        'requested_at',
        'notes',
        'amount_received',
        'payment_status',
    ];

    protected $casts = [
        'total_cost' => 'decimal:2',
        'amount_received' => 'decimal:2',
        'requested_at' => 'datetime',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}