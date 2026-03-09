<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationsIncItem extends Model
{
    //

    use HasFactory;

    protected $table = 'reservations_income_items';

    protected $fillable = [
        'item',

    ];
}
