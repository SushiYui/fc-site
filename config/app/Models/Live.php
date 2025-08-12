<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    protected $fillable = [
        'title', 'description', 'date', 'place', 'ticket_info', 'image_path'
    ];
}
