<div class="flex">
    @can($this->security.'.create')
        <x-btn-primary wire:click.prevent='create' class="flex items-center mb-4">
            <span wire:loading.remove wire:target="create">
                @svg('bx-plus', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
            </span>
            <x-loader wire:loading wire:target="create"></x-loader>
            <span class="hidden sm:inline-flex">{{__('feature.button.add', ['name' => $this->title])}}</span>
        </x-btn-primary>
    @endcan
</div>