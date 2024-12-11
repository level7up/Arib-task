<?php

use App\Models\Task;
use App\Models\User;
use Livewire\Livewire;
use App\Enums\StatusEnum;
use App\Livewire\TaskStatus;
test('test see livewire in Tasks list', function(){
    Livewire::test(TaskStatus::class)
            ->assertSee('Pending');
});
test('test change Task status', function(){
    $user = User::factory()->create();

    $task = Task::create([
        'title' => 'Title',
        'description' => 'Description',
        'user_id'=> $user->id,
    ]);
    Livewire::test(TaskStatus::class)
            ->set('task', $task)
            ->set('status', StatusEnum::Progress)
            ->call('updateStatus')
            ->assertDispatched('status-updated');
});
it('updates the task status', function () {
    $user = User::factory()->create();
    $task = Task::create([
        'title' => 'Title',
        'description' => 'Description',
        'user_id'=> $user->id,
    ]);

    Livewire::test(TaskStatus::class, ['task' => $task])
        ->set('status', StatusEnum::Progress)
        ->call('updateStatus')
        ->assertHasNoErrors()
        ->assertDispatched('status-updated')
        // ->assertSessionHas('message', 'Task status updated successfully!') // ! FLASH DOESNOT CATCHED IN PEST
        ->assertSee('Task status updated successfully!')
        ;

    $task->refresh();
    expect($task->status)->toEqual(StatusEnum::Progress);
});