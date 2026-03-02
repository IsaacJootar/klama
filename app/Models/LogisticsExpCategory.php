<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogisticsExpCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'logistics_expense_categories';

    protected $fillable = [
        'category',
    ];
}
