<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceExpCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'maintenance_expense_categories';

    protected $fillable = [
        'category',
    ];
}
