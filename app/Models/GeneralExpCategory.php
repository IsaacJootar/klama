<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralExpCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'general_expense_categories';

    protected $fillable = [
        'category',
    ];
}
