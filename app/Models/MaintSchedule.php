<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintSchedule extends Model
{
    use HasFactory;
    protected $table="maint_schedules";

    protected $fillable = [
        'task_name',
        'asset_id',
        'frequency',
        'next_scheduled_date',
        'assigned_to',
        'status',
    ];

    /**
     * Get the asset associated with the maintenance schedule.
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get the technician assigned to the maintenance schedule.
     */
    public function technician()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
