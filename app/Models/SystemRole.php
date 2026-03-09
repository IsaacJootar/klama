<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemRole extends Model
{
    protected $table = "system_roles";
    protected $fillable = [
        'role',
    ];
}
