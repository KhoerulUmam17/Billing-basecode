<div class="flex">
    @can($security.'.edit')
        <x-btn-warning wire:click="edit({{ $id }})" class="flex items-center">
            <x-loader wire:loading wire:target="edit({{ $id }})-{{$this->key}}"></x-loader>
            <span wire:loading.remove wire:target='edit({{ $id }})-{{$this->key}}'>
                @svg('bx-edit', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
            </span>
            <span class="hidden sm:inline-flex">Edit / View</span>
        </x-btn-warning>
    @endcan
    @can($security.'.status')        
        @if ($status == 'NON_AKTIF')
            <x-btn-danger :tooltipId="'activate-tooltip'" :tooltipMsg="'Aktifkan'" 
                wire:click="activate({{ $id }})" class="flex items-center">
                <x-loader wire:loading wire:target="activate({{ $id }})-{{$this->key}}"></x-loader>
                <span wire:loading.remove wire:target='activate({{ $id }})-{{$this->key}}'>
                    @svg('bx-toggle-left', ['class' => 'w-4 h-4  inline-flex align-text-bottom'])
                </span>
            </x-btn-danger>
        @else
        <x-btn-primary :tooltipId="'deactivate-tooltip'" :tooltipMsg="'Non Aktifkan'" 
            wire:click="deactivate({{ $id }})" class="flex items-center">
                <x-loader wire:loading wire:target="deactivate({{ $id }})-{{$this->key}}"></x-loader>
                <span wire:loading.remove wire:target='deactivate({{ $id }})-{{$this->key}}'>
                    @svg('bx-toggle-right', ['class' => 'w-4 h-4 inline-flex align-text-bottom'])
                </span>
            </x-btn-primary>
        @endif
    @endcan
    @can($security.'.delete')        
        <x-btn-danger wire:click="confirmDelete({{ $id }})" class="flex items-center">
            <x-loader wire:loading wire:target="confirmDelete({{ $id }})-{{$this->key}}"></x-loader>
            <span wire:loading.remove wire:target='confirmDelete({{ $id }})->{{$this->key}}'>
                @svg('bx-trash', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
            </span>
            <span class="hidden sm:inline-flex">{{__('feature.button.delete')}}</span>
        </x-btn-danger>
    @endcan
</div>