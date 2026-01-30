<x-confirmation-modal wire:model.live="modalDelete">
    <x-slot name="title">
        Hapus Akun
    </x-slot>

    <x-slot name="content">
        Apakah Anda yakin ingin menghapus {{$this->form[$this->displayDelete ?? $this->displayKey] ?? 'ini'}} ?
    </x-slot>

    <x-slot name="footer">
        <x-btn-warning wire:click="cancelModal" wire:loading.attr="disabled">
            <x-loader wire:loading wire:target="cancelModal"></x-loader>
            <span wire:loading.remove wire:target='cancelModal'>
                @svg('bx-x', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
            </span>
            Tutup
        </x-btn-warning>

        <x-btn-danger class="ml-2" wire:click="delete" wire:loading.attr="disabled">
            <x-loader wire:loading wire:target="delete"></x-loader>
            <span wire:loading.remove wire:target='delete'>
                @svg('bx-trash', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
            </span>
            Hapus
        </x-btn-danger>
    </x-slot>
</x-confirmation-modal>
