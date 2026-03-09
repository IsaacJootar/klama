<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceIncItem extends Model
{
    //

    use HasFactory;

    protected $table = 'maintenance_income_items';

    protected $fillable = [
        'item',

    ];
}
