<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    protected $fillable = [
        'user_id', 'blog_id'
    ];

    public function user(){
        return this->belongsTo(user::class);
    }

    public function blog(){
        return this->belongsTo(Blog::class);
    }
}
