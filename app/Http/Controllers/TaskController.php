<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\EmployeeRequest;
use App\Interfaces\TaskRepositoryInterface;

final class TaskController extends Controller
{
	public function __construct(protected TaskRepositoryInterface $repository){}

    public function index()
    {
        $tasks = $this->repository->all();
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
        $employee = $this->repository->find($id);
        return view('employees.single', compact('employee'));
    }
    public function update(EmployeeRequest $request, User $employee)
    {
        $this->repository->update($employee->id ,$request->validated());
        return redirect()->route('employee.index')->with('success', trans('Updated Successfully'));
    }
    public function destroy(User $employee)
    {
        $this->repository->delete($employee->id);
        return redirect()->route('employee.index')->with('success', trans('Deleted Successfully'));
    }

}