<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name'     => 'Admin',
            'middle_name'    => null,
            'last_name'      => 'User',
            'ext_name'       => null,
            'email'          => 'admin@email.com',
            'password'       => Hash::make('admin123'),
            'role'           => 'admin',
            'stat'           => 1,
            'department_id'  => 1,
            'profile_photo'  => 'profile_photos/default.jpg',
            'last_login'     => now(),
        ]);
    }
}
