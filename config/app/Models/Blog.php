<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'body', 'image_path', 'user_id'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function likes(){
        return $this->hasMany(BlogLike::class);
    }

    // App\Models\Blog.php

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
