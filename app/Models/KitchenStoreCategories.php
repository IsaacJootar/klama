<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KitchenStoreCategories extends Model
{
    use HasFactory;

    protected $table = 'fnb_kitchen_store_categories';

    protected $fillable = [
        'category',
    ];
}