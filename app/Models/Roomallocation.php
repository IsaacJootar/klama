<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roomallocation extends Model
{
    protected $table="resv_room_allocations";

    Protected $guarded=[];   // disable mass asignment issue
    
    

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function category()
    {
        return $this->belongsTo(Roomcategory::class, 'category_id');
    }

}
