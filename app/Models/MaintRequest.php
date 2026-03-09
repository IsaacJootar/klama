<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintRequest extends Model
{
    //

    use HasFactory;

    protected $table = "maint_request";

    protected $fillable = ['title', 'description', 'status', 'priority', 'department_id', 'assigned_to', 'asset_id'];

    public function requestingDepartment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function assignedTechnician()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function asset()
    {
        return $this->belongsTo(MaintAsset::class, 'asset_id');
    }
}
