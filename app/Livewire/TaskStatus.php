<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Enums\StatusEnum;

class TaskStatus extends Component
{
    public Task $task;
    public StatusEnum|null $status;
    public function mount(Task $task)
    {
        $this->task = $task;
        $this->status = $task->status;
    }

    public function updateStatus()
    {
        $this->task->update(['status' => $this->status]);
        session()->flash('message', 'Task status updated successfully!');
        $this->dispatch('status-updated');
    }

    public function render()
    {
        return view('livewire.task-status');
    }
}
