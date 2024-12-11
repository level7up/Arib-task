<?php


namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\EmployeeRequest;
use App\Interfaces\TaskRepositoryInterface;

final class TaskController extends Controller
{
	public function __construct(protected TaskRepositoryInterface $repository){}

    public function index()
    {
        $tasks = $this->repository->belongsToMe();
        return view('tasks.index', compact('tasks'));
    }
    public function create()
    {
        return view('tasks.single');
    }
    public function store(TaskRequest $request)
    {
        $this->repository->create($request->validated());
        return redirect()->route('task.index')->with('success', trans('Created Successfully'));
    }
    public function edit($id)
    {
        $task = $this->repository->find($id);
        return view('tasks.single', compact('task'));
    }
    public function update(TaskRequest $request, Task $task)
    {
        $this->repository->update($task->id ,$request->validated());
        return redirect()->route('task.index')->with('success', trans('Updated Successfully'));
    }

}