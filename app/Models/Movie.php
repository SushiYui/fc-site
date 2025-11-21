<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    protected $fillable = [
        'title', 'video_path', 'released_at'
    ];

    protected $casts = [
        'released_at' => 'datetime',
    ];

}
