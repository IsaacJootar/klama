<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintInventories extends Model
{
    //

    protected $table="maint_inventories";

    protected $fillable = [
        'item_name',
        'category_id',
        'price',
        'quantity',
        'restock_threshold',
        'status',
    ];
    public function category() : BelongsTo{

        return $this->belongsTo(Inventorycategory::class, 'category_id','id'); // relation is where cat_id  in  Roomallocation = id in Roomcategory
    }
}

