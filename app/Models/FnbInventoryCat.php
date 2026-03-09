<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FnbInventoryCat extends Model
{
    //
    protected $table="fnb_inventory_cats";

    protected $fillable = [
        'name',
    ];
}
