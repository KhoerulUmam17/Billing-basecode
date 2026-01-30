<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskCard extends Component
{
    public $task;

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    public function render()
    {
        return view('livewire.task-card');
    }
}
