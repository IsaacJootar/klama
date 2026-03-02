<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FnbExpItem extends Model
{
    //

    use HasFactory;

    protected $table = 'fnb_expense_items';

    protected $fillable = [
        'item',

    ];
}
