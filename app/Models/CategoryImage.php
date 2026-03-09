<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryImage extends Model
{
    protected $table = "resv_category_images_uploads";
    protected $fillable = [
        'category',
        'file_name',
        'path',
        'mime_type',
        'size',
        'random_name',
        'date',
    ];
}
