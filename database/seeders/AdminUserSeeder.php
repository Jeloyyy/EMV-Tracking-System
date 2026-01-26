<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@email.com'],
            [
                'first_name'     => 'Admin',
                'middle_name'    => null,
                'last_name'      => 'User',
                'ext_name'       => null,
                'password'       => \Illuminate\Support\Facades\Hash::make('admin123'),
                'role'           => 'admin',
                'stat'           => 1,
                'department_id'  => 1,
                'profile_photo'  => 'profile_photos/default.jpg',
                'last_login'     => now(),
            ]
        );
    }
}