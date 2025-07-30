<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['date', 'category', 'title', 'detail'];

    protected $casts = [
        'date' => 'date',
    ];
}
