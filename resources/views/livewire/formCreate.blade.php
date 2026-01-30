<x-dialog-modal wire:model.live="modalCreate">
    <x-slot name="title">
        Tambah {{$title}} Baru
    </x-slot>

    <x-slot name="content" wire:ignore>
        <form wire:submit="store()" wire:key='create-form'>
            <div @class([ 'grid sm:grid-cols-1'=> $this->formColumn === 1,
                'grid sm:grid-cols-2 sm:gap-6' => $this->formColumn === 2,
                ])>

                @foreach ($fields as $index => $field)
                @if (in_array('form-create', $field['data']['hide']))
                    @continue
                @endif
                @include('components.fields.'.$field['type'], ['type' => $field['type'], 'data' => $field['data'],
                'modal' => 'create'])
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
        <x-btn-primary wire:click="store">
            <span wire:loading.remove wire:target="store">
                @svg('bx-save', ['class' => 'w-4 h-4 sm:mr-2 flex'])
            </span>
            <x-loader wire:loading wire:target="store"></x-loader>
            <span class="inline-flex">
                Simpan
            </span>
        </x-btn-primary>

    </x-slot>
</x-dialog-modal>