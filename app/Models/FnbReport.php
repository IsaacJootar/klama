<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FnbReport extends Model
{
    use HasFactory;

    protected $table = 'fnb_reports'; // Specify the table name

    protected $fillable = [
        'report_id',
        'total_orders',
        'total_revenue',
        'wastage',
        'complaints_received',
        'special_requests',
        'inventory_used',
        'inventory_remaining',
        'user_id',
        'amount',
        'notes',
        'sent_by',
        'sent_to'
    ];
}
