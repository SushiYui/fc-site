<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MV extends Model
{
    protected $table = 'mvs';

    protected $fillable = [
        'title', 'category', 'url', 'released_at'
    ];
}
