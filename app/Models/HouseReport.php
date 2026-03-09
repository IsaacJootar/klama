<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseReport extends Model
{
    use HasFactory;

    protected $table = 'house_reports'; // Specify the table name

    protected $fillable = [
        'report_id',
        'rooms_cleaned',
        'laundry_items_processed',
        'maintenance_requests',
        'deep_cleaning_tasks',
        'supplies_used',
        'amount',
        'notes',
        'sent_by',
        'sent_to',
        'section'
    ];
}
