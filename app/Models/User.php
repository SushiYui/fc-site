<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'postal_code',
        'city',
        'building',
        'phone_number',
        'funclub_member',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'funclub_member' => 'boolean',
        ];
    }

// adminsテーブルにそのユーザーのuser_idが登録されていれば、管理者とみなす
//
        public function admin()
        {
            return $this->hasOne(Admin::class);
        }

        public function blogLikes(){
            return $this->hasMany(BlogLike::class);
        }

        // いいねしてるかどうかの確認
        public function hasLiked($blogId)
        {
            return $this->blogLikes()->where('blog_id', $blogId)->exists();
        }

        // App\Models\User.php

        public function blogs()
        {
            return $this->hasMany(Blog::class);
        }

}
