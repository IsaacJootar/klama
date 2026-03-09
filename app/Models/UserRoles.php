<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = "user_roles";
    protected $fillable = [
        'user_id',
        'role',
        'aka',
        'section',
    ];




    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
