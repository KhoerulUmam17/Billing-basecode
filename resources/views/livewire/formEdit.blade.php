<x-dialog-modal wire:model.live="modalEdit">
    <x-slot name="title">
        Edit {{$title}}
    </x-slot>

    <x-slot name="content">
        <form wire:submit="update()" wire:key='edit-form'>
            <div @class([
                'grid sm:grid-cols-1' => $this->formColumn === 1,
                'grid sm:grid-cols-2 sm:gap-6' => $this->formColumn === 2,
            ])>
                <input type="hidden" name="id" wire:model="form.{{ $this->key }}">
                @foreach ($fields as $index => $field)
                    @if (in_array('form-edit', $field['data']['hide']))
                        @continue
                    @endif
                    @include('components.fields.'.$field['type'], ['type' => $field['type'], 'data' => $field['data'], 'modal' => 'edit'])
                @endforeach
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-btn-danger wire:click="cancelModal">
            <span wire:loading.remove wire:target="cancelModal">
                @svg('bx-x-circle', ['class' => 'w-4 h-4 sm:mr-2 flex'])
            </span>
            <x-loader wire:loading wire:target="cancelModal"></x-loader>
            <span class="inline-flex">
                Tutup
            </span>
        </x-btn-danger>

        <x-btn-primary wire:click="update">
            <span wire:loading.remove wire:target="update">
                @svg('bx-save', ['class' => 'w-4 h-4 sm:mr-2 flex'])
            </span>
            <x-loader wire:loading wire:target="update"></x-loader>
            <span class="inline-flex">
                Update
            </span>
        </x-btn-primary>
    </x-slot>
</x-dialog-modal>
