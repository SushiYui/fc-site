<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    
// adminsテーブルにそのユーザーのuser_idが登録されていれば、管理者とみなす
    public function user()
{
    return $this->belongsTo(User::class);
}
}
