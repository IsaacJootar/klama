<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FnbIncItem extends Model
{
    //

    use HasFactory;

    protected $table = 'fnb_income_items';

    protected $fillable = [
        'item',

    ];
}
