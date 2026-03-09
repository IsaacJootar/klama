<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomcategory extends Model
{
    protected $table="resv_room_categories";

    Protected $guarded=[];   // disable mass asignment issue
    
    
    public function room_allocations()
    {
        return $this->hasMany(RoomAllocation::class, 'category_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'category_id');
    }

}
