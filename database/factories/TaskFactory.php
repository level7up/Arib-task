<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'user_id'=> User::factory()->create([
                'role_id' => function () {
                    return Role::inRandomOrder()->first()->id;
                },
                'department_id' => function () {
                    return Department::inRandomOrder()->first()->id;
                },
            ])->id,
            'status'=> 1,
        ];
    }
    public function withUsers(int $count = 2): static
    {
        return $this->afterCreating(function (Task $task) use ($count) {
            $users = User::factory()->count($count)->create([
                'role_id' => function () {
                    return Role::inRandomOrder()->first()->id;
                },
                'department_id' => function () {
                    return Department::inRandomOrder()->first()->id;
                },
            ]);
            $task->users()->attach($users);
        });
    }
}
