<x-dialog-modal wire:model.live="modalUpload">
    <x-slot name="title">
        Upload File Excel
    </x-slot>

    <x-slot name="content">
        <form wire:submit="upload()" wire:key='create-form'>
            <div @class([
                'grid sm:grid-cols-1' => $this->formColumnUpload === 1,
                'grid sm:grid-cols-2 sm:gap-6' => $this->formColumnUpload === 2,
            ])>


                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Upload file excel</label>
                <input name="xlsx" type="file" accept=".xls,.xlsx" id="upload-{{$this->idFileForReset}}" wire:model="request.xlsx"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="user_avatar_help">Silahkan unduh template <button class="text-info" wire:click.prevent='downloadTemplate'>disini</button></div>
            </div>
            <div wire:loading wire:target="request.xlsx">
                Loading...
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-btn-danger wire:click="cancelModalUpload">
            <span wire:loading.remove wire:target="cancelModalUpload">
                @svg('bx-x-circle', ['class' => 'w-4 h-4 sm:mr-2 flex'])
            </span>
            <x-loader wire:loading wire:target="cancelModalUpload"></x-loader>
            <span class="inline-flex">
                Tutup
            </span>
        </x-btn-danger>
        
        <x-btn-primary wire:click="upload">
            <span wire:loading.remove wire:target="upload">
                @svg('bx-save', ['class' => 'w-4 h-4 sm:mr-2 flex'])
            </span>
            <x-loader wire:loading wire:target="upload"></x-loader>
            <span class="inline-flex">
                Upload
            </span>
        </x-btn-primary>
    </x-slot>
</x-dialog-modal>
