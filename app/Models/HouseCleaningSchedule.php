<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseCleaningSchedule extends Model
{
    //
    use HasFactory;

    // Define the table name
    protected $table = 'house_cleaning_schedules';

    // Define the fields
    protected $fillable = [
        'room_id',
        'user_id',
        'cleaning_date',
        'shift',
        'status',
    ];

    // Cast dates to Carbon instances
    protected $casts = [
        'cleaning_date' => 'date',
    ];

    // Relationship to the Room model
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
