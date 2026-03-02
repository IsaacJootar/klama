<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralExpItem extends Model
{
    //

    use HasFactory;

    protected $table = 'general_expense_items';

    protected $fillable = [
        'item',

    ];
}
