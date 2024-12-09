<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create([
            'role_id' => function () {
                return Role::inRandomOrder()->first()->id;
            },
            'department_id' => function () {
                return Department::inRandomOrder()->first()->id;
            },
        ]);
    }
}
