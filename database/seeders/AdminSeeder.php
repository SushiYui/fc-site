<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::insert([
            [
                'name' => 'うさぎ',
                'email' => 'usagi@usagi.com',
                'password' => Hash::make('usagi'),
                'user_id' => 4,
            ],
            [
                'name' => 'スタッフ',
                'email' => 'staff@staff.com',
                'password' => Hash::make('staff'),
                'user_id' => 5,
            ],
        ]);
    }
}
