<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::firstOrCreate(['title' => 'IT']);
        Department::firstOrCreate(['title' => 'HR']);
        Department::firstOrCreate(['title' => 'Finance']);
    }
}
