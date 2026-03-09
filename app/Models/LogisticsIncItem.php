<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogisticsIncItem extends Model
{
    //

    use HasFactory;

    protected $table = 'logistics_income_items';

    protected $fillable = [
        'item',

    ];
}
