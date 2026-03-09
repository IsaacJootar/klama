<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KitchenStoreInventories extends Model
{
    use HasFactory;

    protected $table = 'fnb_kitchen_store_inventory';

    protected $fillable = [
        'item_id',
        'quantity',
        'last_updated',
    ];

    public function item()
    {
        return $this->belongsTo(KitchenStoreItems::class, 'item_id');
    }
}