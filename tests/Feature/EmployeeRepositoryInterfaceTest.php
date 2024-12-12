<?php
use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Collection;
use App\Interfaces\EmployeeRepositoryInterface;

it('can fetch all employees', function () {
    $repository = mock(EmployeeRepositoryInterface::class);
    $employees = User::factory()->count(3)->create();

    $repository->shouldReceive('all')->andReturn($employees);

    $result = $repository->all();

    expect($result)->toBeInstanceOf(Collection::class);
    expect(count($result))->toBe(3);
});

it('can find a employee by ID', function () {
    $repository = mock(EmployeeRepositoryInterface::class);
    $employee = User::factory()->create();

    $repository->shouldReceive('find')->with($employee->id)->andReturn($employee);

    $result = $repository->find($employee->id);

    expect($result)->toBeInstanceOf(User::class);
    expect($result->id)->toBe($employee->id);
});

it('can create a new employee', function () {
    $repository = mock(EmployeeRepositoryInterface::class);
    $attributes = [
        'first_name' => 'New',
        'last_name' => 'User',
        'email' => 'new@test.com',
        'phone' => '01002874070',
        'password'=> 'password',
        'salary' => '150',
        'role_id' => Role::factory()->create()->id,
        'department_id' => Department::factory()->create()->id,
    ];

    $repository->shouldReceive('create')->with($attributes)->andReturn(new User($attributes));

    $employee = $repository->create($attributes);

    expect($employee)->toBeInstanceOf(User::class);
    expect($employee->first_name)->toBe($attributes['first_name']);
    expect($employee->name)->toBe($attributes['first_name']. " ". $attributes['last_name']);
});


test('can update an existing employee', function () {
    $repository = mock(EmployeeRepositoryInterface::class);
    $employee = User::factory()->create();
    $updatedAttributes = [
        'first_name' => 'Updated First Name',
        'last_name' => 'Updated Last Name'
    ];

    $repository->shouldReceive('update')->with($employee->id, $updatedAttributes)->andReturn(true);

    $result = $repository->update($employee->id, $updatedAttributes);

    expect($result)->toBeTrue();
});

it('can delete a employee', function () {
    $repository = mock(EmployeeRepositoryInterface::class);
    $employee = User::factory()->create();

    $repository->shouldReceive('delete')->with($employee->id)->andReturn(true);

    $result = $repository->delete($employee->id);
    expect($result)->toBeTrue();
    // expect(User::find($employee->id))->toBeNull();
});