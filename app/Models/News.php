<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'body', 'published_at'];

    protected $casts = [
        'published_at' => 'date',
    ];
}
