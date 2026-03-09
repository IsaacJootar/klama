<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FnbSystemMessage extends Model
{
    //
    protected $table = "fnb_system_messages";
    protected $fillable = [
        'message_id', //
        'message',
        'message_type',
        'sent_by',
        'sent_to',
        'section',
        'date',
    ];
}
