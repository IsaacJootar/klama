<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = "logis_reports";
    protected $fillable = [
        'report_id', // must on all reports
        'user_id',
        'trips_made',
        'airport_pickups',
        'breakdowns',
        'other',
        'note', // from here, all fields must on all reports, no matter the section
        'sent_by',
        'sent_to',
        'section',
        'date',


    ];
}
