<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = ['title', 'category_id', 'file_path', 'size', 'downloads_count'];
}
