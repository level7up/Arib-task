<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\EmployeeRequest;
use App\Interfaces\EmployeeRepositoryInterface;

final class EmployeeController extends Controller
{
	public function __construct(protected EmployeeRepositoryInterface $repository){}

    public function index()
    {
        $employees = $this->repository->all();
        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        return view('employees.single');
    }
    public function store(EmployeeRequest $request)
    {
        $this->repository->create($request->validated());
        return redirect()->route('employee.index')->with('success', trans('Created Successfully'));
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