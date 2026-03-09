<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationsIncCategory extends Model
{
    //

    use HasFactory;

    protected $table = 'reservations_income_categories';

    protected $fillable = [
        'category',
    ];
}
