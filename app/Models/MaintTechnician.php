<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintTechnician extends Model
{
    //

    use HasFactory;
    protected $table="maint_technicians";

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'is_active',
    ];
}
