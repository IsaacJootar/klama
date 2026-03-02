<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseRoomStatus extends Model
{
    //
    use HasFactory;

    // Define the table name
    protected $table = 'house_room_statuses';

    // Define the fields
    protected $fillable = [
        'room_id',
        'status',
        'last_cleaned_at',
        'next_cleaning_due',
    ];

        // Cast dates to Carbon instances
        protected $casts = [
            'last_cleaned_at' => 'datetime',
            'next_cleaning_due' => 'date',
        ];

        // Relationship to the Room model
        public function room()
        {
            return $this->belongsTo(Room::class, 'room_id');
        }
}
