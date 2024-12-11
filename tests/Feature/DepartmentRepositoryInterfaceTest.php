<?php
use App\Models\Department;
use Illuminate\Support\Collection;
use App\Interfaces\DepartmentRepositoryInterface;

// it('can fetch all departments', function () {
//     $repository = mock(DepartmentRepositoryInterface::class);
//     $departments = Department::factory()->count(3)->create();

//     $repository->shouldReceive('all')->andReturn($departments);

//     $result = $repository->all();

//     expect($result)->toBeInstanceOf(Collection::class);
//     expect(count($result))->toBe(3);
// });

// it('can find a department by ID', function () {
//     $repository = mock(DepartmentRepositoryInterface::class);
//     $department = Department::factory()->create();

//     $repository->shouldReceive('find')->with($department->id)->andReturn($department);

//     $result = $repository->find($department->id);

//     expect($result)->toBeInstanceOf(Department::class);
//     expect($result->id)->toBe($department->id);
// });

// it('can create a new department', function () {
//     $repository = mock(DepartmentRepositoryInterface::class);
//     $attributes = [
//         'name' => 'New Department',
//         // ... other attributes
//     ];

//     $repository->shouldReceive('create')->with($attributes)->andReturn(new Department($attributes));

//     $department = $repository->create($attributes);

//     expect($department)->toBeInstanceOf(Department::class);
//     expect($department->name)->toBe($attributes['name']);
//     // ... other assertions
// });

// it('can update an existing department', function () {
//     $repository = mock(DepartmentRepositoryInterface::class);
//     $department = Department::factory()->create();
//     $updatedAttributes = ['name' => 'Updated Name'];

//     $repository->shouldReceive('update')->with($department->id, $updatedAttributes)->andReturn(true);

//     $result = $repository->update($department->id, $updatedAttributes);

//     expect($result)->toBeTrue();
//     $department->refresh();
//     expect($department->name)->toBe($updatedAttributes['name']);
// });

// it('can delete a department', function () {
//     $repository = mock(DepartmentRepositoryInterface::class);
//     $department = Department::factory()->create();

//     $repository->shouldReceive('delete')->with($department->id)->andReturn(true);

//     $result = $repository->delete($department->id);

//     expect($result)->toBeTrue();
//     expect(Department::find($department->id))->toBeNull();
// });