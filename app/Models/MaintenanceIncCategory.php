<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceIncCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'maintenance_income_categories';

    protected $fillable = [
        'category',
    ];
}
