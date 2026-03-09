<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintHistories extends Model
{
    use HasFactory;

    protected $table="maint_histories";

    protected $fillable = [
        'request_id',
        'asset_id',
        'assigned_to',
        'task_description',
        'date_completed',
    ];

    // Relationships
    public function request()
    {
        return $this->belongsTo(MaintRequest::class, 'request_id');
    }

    public function asset()
    {
        return $this->belongsTo(MaintAsset::class, 'asset_id');
    }

}
