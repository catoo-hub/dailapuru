<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@dailapu.test'],
            [
                'name' => 'Администратор',
                'phone' => '+7 900 000-00-00',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'blocked_at' => null,
            ],
        );
    }
}
