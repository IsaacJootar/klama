<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationsExpCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'reservations_expense_categories';

    protected $fillable = [
        'category',
    ];
}
