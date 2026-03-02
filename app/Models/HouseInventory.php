<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseInventory extends Model
{
    //
    protected $table="house_inventories";

    protected $fillable = [
        'item_name',
        'category_id',
        'price',
        'quantity',
        'condition',
    ];
}
