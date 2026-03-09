<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReservationsExpItem extends Model
{
    //

    use HasFactory;

    protected $table = 'reservations_expense_items';

    protected $fillable = [
        'item',

    ];
}
