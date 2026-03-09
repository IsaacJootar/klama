<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KitchenStoreItems extends Model
{
    use HasFactory;

    protected $table = 'fnb_kitchen_store_items';

    protected $fillable = [
        'item',
        'measurement_tag',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(KitchenStoreCategories::class, 'category_id');
    }
}