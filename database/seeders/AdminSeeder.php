<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrInsert(
            ['email' => 'usagi@usagi.com'],
            [
                'name' => 'うさぎ',
                'password' => Hash::make('usagi'),
                'user_id' => 4,
            ]
        );

        Admin::updateOrInsert(
            ['email' => 'staff@staff.com'],
            [
                'name' => 'スタッフ',
                'password' => Hash::make('staff'),
                'user_id' => 5,
            ]
        );


$testUserId = config('seeder.test_user_id');

Admin::updateOrInsert(
    ['email' => 'test@example.com'],
    [
        'name' => 'テスト管理者',
        'password' => Hash::make('password'),
        'user_id' => $testUserId, // nullじゃなく整数が入る
    ]
);
}
}
