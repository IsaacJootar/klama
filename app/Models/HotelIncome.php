<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelIncome extends Model
{
    //

    use HasFactory;

    protected $table = 'hotel_income';

    protected $fillable = [
        'category_id',
        'item_id',
        'user_id',
        'amount',
        'note',
        'section',
        'income_code',
        'income_title',
        'income_date',
        
    ];
}
