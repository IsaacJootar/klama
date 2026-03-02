<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralIncItem extends Model
{
    //

    use HasFactory;

    protected $table = 'general_income_items';

    protected $fillable = [
        'item',

    ];
}
