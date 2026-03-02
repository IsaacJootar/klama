<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintInventoryCat extends Model
{
    //
    protected $table="maint_inventory_cat";

    protected $fillable = [
        'name',
    ];
}
