<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FnbExpCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'fnb_expense_categories';

    protected $fillable = [
        'category',
    ];
}
