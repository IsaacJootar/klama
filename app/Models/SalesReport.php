<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReport extends Model
{
    use HasFactory;

    protected $table = 'sales_reports'; // Specify the table name

    protected $fillable = [
        'report_id',
        'total_sales',
        'revenue_generated',
        'new_clients',
        'follow_ups',
        'deals_closed',
        'refunds_processed',
        'amount',
        'notes',
        'sent_by',
        'sent_to',
        'section'
    ];
}
