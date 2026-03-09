<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesCampaign extends Model
{
    use HasFactory;

    // Optional: explicitly specify the table name if it doesn't follow Laravel's default naming convention.
    protected $table = 'sales_campaigns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'campaign_name',
        'campaign_type',
        'description',
        'start_date',
        'end_date',
        'budget',
        'performance_metrics',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date'           => 'date',
        'end_date'             => 'date',
        'budget'               => 'decimal:2',
        'performance_metrics'  => 'array', // Converts JSON into an array
    ];
}
