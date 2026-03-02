<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogisticsExpItem extends Model
{
    //

    use HasFactory;

    protected $table = 'logistics_expense_items';

    protected $fillable = [
        'item',

    ];
}
