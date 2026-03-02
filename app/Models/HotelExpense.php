<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HotelExpense extends Model
{
    //

    use HasFactory;

    protected $table = 'hotel_expenses';

    protected $fillable = [
        'category_id',
        'item_id',
        'user_id',
        'amount',
        'note',
        'section',
        'expense_code',
        'expense_title',
        'expense_date',
        'list_flag',
        
    ];
}
