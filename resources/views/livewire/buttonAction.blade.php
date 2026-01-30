<div class="flex">
    @can($security.'.edit')
        <x-btn-warning wire:click="edit({{ $id }})" class="flex items-center">
            <span wire:loading.remove wire:target="edit({{ $id }})-{{$this->key}}">
                @svg('bx-edit', ['class' => 'w-4 h-4 sm:mr-2 flex'])
            </span>
            <x-loader wire:loading wire:target="edit({{ $id }})-{{$this->key}}"></x-loader>
            <span class="hidden sm:inline-flex">Edit / View</span>
        </x-btn-warning>
        @endcan
    @can($security.'.delete')
        <x-btn-danger wire:click="confirmDelete({{ $id }})" class="flex items-center">
            <span wire:loading.remove wire:target="confirmDelete({{ $id }})-{{$this->key}}">
                @svg('bx-trash', ['class' => 'w-4 h-4 sm:mr-2 flex'])
            </span>
            <x-loader wire:loading wire:target="confirmDelete({{ $id }})-{{$this->key}}"></x-loader>
            <span class="hidden sm:inline-flex">{{__('feature.button.delete')}}</span>
        </x-btn-danger>
    @endcan
</div>