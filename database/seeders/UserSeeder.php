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
        User::create([
            'first_name'=> 'Admin',
            'last_name'=> 'User',
            'phone'=> '01002874060',
            'email'=> 'admin@arib.test',
            'department_id'=> Department::value('id'),
            'role_id'=> Role::where('name', 'Manager')->value('id'),
            'password'=> 'password',
            'salary'=> 0
        ]);
        // User::factory()->count(5)->create([
        //     'role_id' => function () {
        //         return Role::inRandomOrder()->first()->id;
        //     },
        //     'department_id' => function () {
        //         return Department::inRandomOrder()->first()->id;
        //     },
        // ]);
    }
}
