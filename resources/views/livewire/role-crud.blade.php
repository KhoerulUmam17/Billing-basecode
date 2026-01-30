<div>
    @if ($this->page == 'list')
        @include('livewire.custom.roles-crud.list')
    @elseif($this->page == 'edit')
        @include('livewire.custom.roles-crud.edit')
    @endif

    @include('livewire.confirmDelete')

    @push('scripts')
        <script>
            Livewire.on('changeUrl', url => {
                history.pushState(null, '', url);
            });
        </script>
    @endpush
</div>
