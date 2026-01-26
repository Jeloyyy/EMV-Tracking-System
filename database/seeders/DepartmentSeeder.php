<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = ['Admin','Human Resources', 'Finance', 'IT', 'Operations'];

        foreach ($departments as $dept) {
            \App\Models\Department::firstOrCreate(['name' => $dept]);
        }
    }
}