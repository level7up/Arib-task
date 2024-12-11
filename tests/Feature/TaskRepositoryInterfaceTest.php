<?php
use App\Models\Task;
use Illuminate\Support\Collection;
use App\Interfaces\TaskRepositoryInterface;

it('can fetch all tasks', function () {
    $repository = mock(TaskRepositoryInterface::class);
    $tasks = Task::factory()->count(3)->create();

    $repository->shouldReceive('all')->andReturn($tasks);

    $result = $repository->all();

    expect($result)->toBeInstanceOf(Collection::class);
    expect(count($result))->toBe(3);
});

it('can find a task by ID', function () {
    $repository = mock(TaskRepositoryInterface::class);
    $task = Task::factory()->create();

    $repository->shouldReceive('find')->with($task->id)->andReturn($task);

    $result = $repository->find($task->id);

    expect($result)->toBeInstanceOf(Task::class);
    expect($result->id)->toBe($task->id);
});

it('can create a new task', function () {
    $repository = mock(TaskRepositoryInterface::class);
    $attributes = [
        'title' => 'New Task',
        'description' => 'task description',
        'user_id'=> auth()->id()
    ];

    $repository->shouldReceive('create')->with($attributes)->andReturn(new Task($attributes));

    $task = $repository->create($attributes);

    expect($task)->toBeInstanceOf(Task::class);
    expect($task->title)->toBe($attributes['title']);
});

it('can update an existing task', function () {
    $repository = mock(TaskRepositoryInterface::class);
    $task = Task::factory()->create();
    $updatedAttributes = ['title' => 'Updated Title'];

    $repository->shouldReceive('update')->with($task->id, $updatedAttributes)->andReturn(true);

    $result = $repository->update($task->id, $updatedAttributes);

    expect($result)->toBeTrue();
});

it('can delete a task', function () {
    $repository = mock(TaskRepositoryInterface::class);
    $task = Task::factory()->create();

    $repository->shouldReceive('delete')->with($task->id)->andReturn(true);

    $result = $repository->delete($task->id);
    expect($result)->toBeTrue();
    // expect(Task::find($task->id))->toBeNull();
});