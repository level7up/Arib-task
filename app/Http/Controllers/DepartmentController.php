<?php


namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Interfaces\DepartmentRepositoryInterface;

final class DepartmentController extends Controller
{
	public function __construct(protected DepartmentRepositoryInterface $repository){}

    public function index()
    {
        $departments = $this->repository->all();
        return view('departments.index', compact('departments'));
    }
    public function create()
    {
        abort_unless(auth()->user()->hasRole('Manager'),401);
        return view('departments.single');
    }
    public function store(DepartmentRequest $request)
    {
        $this->repository->create($request->validated());
        return redirect()->route('department.index')->with('success', trans('Created Successfully'));
    }
    public function edit($id)
    {
        $department = $this->repository->find($id);
        return view('departments.single', compact('department'));
    }
    public function update(DepartmentRequest $request, Department $department)
    {
        $this->repository->update($department->id ,$request->validated());
        return redirect()->route('department.index')->with('success', trans('Updated Successfully'));
    }
    public function destroy(Department $department)
    {
        $this->repository->delete($department->id);
        return redirect()->route('department.index')->with('success', trans('Deleted Successfully'));
    }

}