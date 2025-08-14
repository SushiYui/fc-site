<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ユーザー登録（管理者用テストユーザー）
        $testUser = User::updateOrCreate(
            ['email' => 'test@example.com'], // 検索条件
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'postal_code' => '123-4567',
                'city' => '東京都新宿区',
                'building' => 'サンプルビル101',
                'phone_number' => '090-1234-5678',
            ]
        );

        // IDをConfigに一時保存（整数）
        config(['seeder.test_user_id' => $testUser->id]);

        // AdminSeeder呼び出し
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
