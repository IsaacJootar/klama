<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseHousekeepingTask extends Model
{
    //
    use HasFactory;

    // Define the table name
    protected $table = 'house_housekeeping_tasks';

    // Define the fields
    protected $fillable = [
        'room_id',
        'staff_id',
        'task_description',
        'task_status',
        'priority',
        'scheduled_date',
        'completed_date',
    ];

    // Cast dates to Carbon instances
    protected $casts = [
        'scheduled_date' => 'date',
        'completed_date' => 'date',
    ];

    // Relationship to the Room model
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

}
