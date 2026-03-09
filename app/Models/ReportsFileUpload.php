<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportsFileUpload extends Model
{
    protected $table = "reports_upload_files";
    protected $fillable = [
        'report_id', // secondary key from individual reports table
        'user_id',
        'file_name',
        'path',
        'mime_type',
        'size',
        'random_name',
        'sent_by',
        'sent_to',
        'user_id',
        'section',
        'date',
    ];
}
