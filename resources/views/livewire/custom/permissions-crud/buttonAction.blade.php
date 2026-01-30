<div class="flex">
    {{-- @can($security.'.edit')
        <x-btn-warning wire:click="edit({{ $id }})" class="flex items-center">
            @svg('bx-edit', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
            <span class="hidden sm:inline-flex">Edit</span>
        </x-btn-warning>
    @endcan --}}
    @can($security.'.delete')
        <x-btn-danger wire:click="confirmDelete({{ $id }})" class="flex items-center">
            <span>
                @svg('bx-trash', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
            </span>
            <span class="hidden sm:inline-flex">Delete</span>
        </x-btn-danger>
    @endcan
</div>