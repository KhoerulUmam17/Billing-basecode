<div>
    <div class="grid grid-cols-12 gap-x-6">
        <div wire:ignore class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 col-span-4">
            <h2>To Dos</h2>
            <div wire:ignore class="kanban-column" id="todo-column" data-status="todo">
                @foreach($tasks->where('status', 'todo') as $task)
                <div class="task-card" data-task-id="{{ $task->id }}">
                    <h3>{{ $task->title }}</h3>
                    <p>{{ $task->description }} - {{$task->id}}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div wire:ignore class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 col-span-4">
            <h2>In Progress</h2>
            <div wire:ignore class="kanban-column" id="in-progress-column" data-status="in-progress">
                @foreach ($tasks->where('status', 'in-progress') as $task)
                <div class="task-card" data-task-id="{{ $task->id }}">
                    <h3>{{ $task->title }}</h3>
                    <p>{{ $task->description }} - {{$task->id}}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div wire:ignore class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 col-span-4">
            <h2>Done</h2>
            <div wire:ignore class="kanban-column" id="done-column" data-status="done">
                @foreach ($tasks->where('status', 'done') as $task)
                <div class="task-card" data-task-id="{{ $task->id }}">
                    <h3>{{ $task->title }}</h3>
                    <p>{{ $task->description }} - {{$task->id}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>

    <script>
        document.addEventListener('livewire:init', function () {
                initializeSortable();
            });

            Livewire.hook('message.processed', (message, component) => {
                initializeSortable();
            });

            function initializeSortable() {
                const columns = document.querySelectorAll('.kanban-column');
                columns.forEach(column => {
                    new Sortable(column, {
                        group: 'kanban',
                        animation: 150,
                        onEnd: function (event) {
                            // console.log(event);
                            // console.log(column);
                            let taskId = event.item.getAttribute('data-task-id');
                            let newStatus = event.to.getAttribute('data-status');
                            Livewire.dispatch('taskMoved', { taskId, newStatus });
                        },
                    });
                });
            }
    </script>
    @endsection
</div>