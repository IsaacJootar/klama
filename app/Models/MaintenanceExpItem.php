<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceExpItem extends Model
{
    //

    use HasFactory;

    protected $table = 'maintenance_expense_items';

    protected $fillable = [
        'item',

    ];
}
