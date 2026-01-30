<div>
    <div class="flex">
        @can($this->security.'.create')
            <x-btn-primary wire:click.prevent='createPage' class="flex items-center mb-4">
                <span wire:loading.remove wire:target="createPage">
                    @svg('bx-plus', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
                </span>
                <x-loader wire:loading wire:target="createPage"></x-loader>
                <span class="hidden sm:inline-flex">{{__('feature.button.add', ['name' => $this->title])}}</span>
            </x-btn-primary>
        @endcan
        @can($security.'.upload')            
            <x-btn-secondary wire:click.prevent='confirmUpload' class="flex items-center mb-4">
                <span wire:loading.remove wire:target="confirmUpload">
                    @svg('lucide-upload', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
                </span>
                <x-loader wire:loading wire:target="confirmUpload"></x-loader>
                <span class="hidden sm:inline-flex">Upload</span>
            </x-btn-secondary>
        @endcan
    </div>
</div>
