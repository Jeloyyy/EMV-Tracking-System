<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = ['Admin','Human Resources', 'Finance', 'IT', 'Operations'];

        foreach ($departments as $dept) {
            Department::create(['name' => $dept]);
        }
    }
}
