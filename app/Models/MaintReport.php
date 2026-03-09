<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintReport extends Model
{
    use HasFactory;

    protected $table = 'maint_reports'; // Specify the table name

    protected $fillable = [
        'report_id',
        'equipment_checked',
        'repairs_done',
        'faults_reported',
        'emergency_repairs',
        'scheduled_maintenance',
        'amount',
        'notes',
        'sent_by',
        'sent_to',
        'section'
    ];
}
