<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseInventoryCat extends Model
{
    //
    protected $table="house_inventory_cats";

    protected $fillable = [
        'name',
    ];
}
