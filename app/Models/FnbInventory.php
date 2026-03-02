<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FnbInventory extends Model
{
    //
    
    protected $table="fnb_inventories";

    protected $fillable = [
        'item_name',
        'category_id',
        'price',
        'quantity',
        'condition',
    ];
}
