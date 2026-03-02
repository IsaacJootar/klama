<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogisticsIncCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'logistics_income_categories';

    protected $fillable = [
        'category',
    ];
}
