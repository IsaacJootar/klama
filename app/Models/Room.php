<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "resv_rooms";

    protected $guarded=[];
    
    public function category()
    {
        return $this->belongsTo(Roomcategory::class, 'category_id');
    }
}
