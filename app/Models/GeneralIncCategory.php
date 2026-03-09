<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralIncCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'general_income_categories';

    protected $fillable = [
        'category',
    ];
}
