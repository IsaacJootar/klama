<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KitchenStoreLogs extends Model
{
    protected $table = 'fnb_kitchen_store_logs';

    protected $fillable = [
        'item_id',
        'action',
        'quantity_changed',
        'quantity_before',
        'quantity_after',
        'timestamp',
        'user_id',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'quantity_changed' => 'decimal:2',
        'quantity_before' => 'decimal:2',
        'quantity_after' => 'decimal:2',
    ];

    public function item()
    {
        return $this->belongsTo(KitchenStoreItems::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}