<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintAsset extends Model
{
    //

    protected $table="maint_assets";
    protected $fillable = [
        'id',                // Allow mass assignment of the ID field
        'name',
        'category_id',
        'location',
        'purchase_date',
        'last_maintenance_date',
        'status',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'last_maintenance_date' => 'date',
    ];
    public function category() : BelongsTo{

        return $this->belongsTo(MaintAssetCat::class, 'category_id','id'); // relation is where cat_id
    }

}
