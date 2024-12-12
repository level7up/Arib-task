<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = ['Manager', 'Staff'];
        return [
            'name' => $roles[array_rand($roles)],
        ];
    }
}
