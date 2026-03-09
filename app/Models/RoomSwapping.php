<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomSwapping extends Model
{
    protected $table = "resv_room_swap";
    protected $fillable = [
        'reservation_id', //
        'swap_type',
        'swapped_from',
        'swapped_to',
        'new_value',
        'user_id',
        'date',
    ];
}
 // come back apply the appropriate eloquent relation later
