<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FnbIncCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'fnb_income_categories';

    protected $fillable = [
        'category',
    ];
}
