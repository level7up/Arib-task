<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Enums\StatusEnum;

class TaskStatus extends Component
{
    public Task $task;
    public StatusEnum $status;
    public function mount(Task $task)
    {
        $this->task = $task;
        $this->status = $task->status;
    }

    public function updateStatus()
    {
        // dd($this->status->value);
        $this->task->update(['status' => $this->status]);


        session()->flash('message', 'Task status updated successfully!');
    }

    public function render()
    {
        return view('livewire.task-status');
    }
}
