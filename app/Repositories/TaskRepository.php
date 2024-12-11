<?php
namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use App\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function __construct(protected Task $task){}


    public function all()
    {
        return $this->task->all();
    }
    public function belongsToMe()
    {
        return $this->task
        ->where('user_id', auth()->id())
        ->orWhereHas('users', function ($query)  {
            $query->where('user_id', auth()->id()); // Tasks assigned to the user
        })->get();
    }

    public function find($id)
    {
        return $this->task->find($id);
    }

    public function create(array $attributes)
    {
        $employee_id = $attributes['employee_id'];
        $attributes['user_id'] = auth()->id();
        unset($attributes['employee_id']);
        $task = $this->task->create($attributes);
        $user = User::find($employee_id);
        $task->users()->attach($user);
        return $task;
    }

    public function update($id, array $attributes)
    {
        $task = $this->find($id);
        $task->update($attributes);
        return $task;
    }

    public function delete($id)
    {
        $task = $this->find($id);
        $task->delete();
    }
}