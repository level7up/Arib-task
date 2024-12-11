<?php
namespace App\Repositories;

use App\Models\Department;
use App\Interfaces\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function __construct(protected  Department $department){}


    public function all()
    {
        return $this->department->all();
    }

    public function find($id)
    {
        return $this->department->find($id);
    }

    public function create(array $attributes)
    {
        return $this->department->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $department = $this->find($id);
        $department->update($attributes);
        return $department;
    }

    public function delete($id)
    {
        $department = $this->find($id);
        $department->delete();
    }
}