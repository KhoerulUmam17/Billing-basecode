<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class KanbanBoard extends Component
{
    public $tasks;

    protected $listeners = ['taskUpdated' => 'render', 'taskMoved'];

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function taskMoved($taskId, $newStatus)
    {
        $task = Task::find($taskId);
        $task->status = $newStatus;
        $task->save();
        $this->render();
    }

    public function render()
    {
        return view('livewire.kanban-board');
    }
}
