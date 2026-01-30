<div class="mb-6">
    <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
        {{$data['text']}}
        @if (in_array('required', $data['rules']))
            <span class="text-danger"> *</span>
        @endif
    </label>
    <select wire:model.blur="form.{{$data['name']}}" id="form.{{$data['name']}}-{{$modal}}"
        class="@error('form.'.$data['name']) is-invalid @enderror form-control">
        <option value="null">{{ __('Please select') }}</option>
        @foreach ($data['options'] as $key => $value)
            <option value="{{ $key }}" wire:key="{{$data['name']}}-{{ $key }}">
                {{ $value }}</option>
        @endforeach
    </select>
    @error('form.'.$data['name'])
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

{{-- <div class="mb-6">
    <div>
        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
            {{$data['text']}}
            @if (in_array('required', $data['rules']))
                <span class="text-danger"> *</span>
            @endif
        </label>
    </div>
    <div x-data="{ 
        open: false,
        selected: @entangle('form.' . $data['name']).live,
        options: @js($data['options']),
        search: '',
        isLoading: false,
        init() {
            this.updateSearchFromSelected();
            // Listener untuk mengupdate search ketika modal dibuka atau nilai selected berubah
            this.$watch('selected', () => this.updateSearchFromSelected());
            this.$watch('search', value => {
                if (value === '') {
                    this.selected = '';
                }
            });
        },
        updateSearchFromSelected() {
            // Pastikan ini dijalankan setelah semua inisialisasi selesai
            this.$nextTick(() => {
                if (this.selected && this.options[this.selected]) {
                    this.search = this.options[this.selected];
                } else {
                    this.search = '';
                }
            });
        },
        selectOption(key, value) {
            this.isLoading = true;
            this.selected = key;
            this.search = value;
            this.open = false;

            // Contoh asumsi proses asynchronous, misalnya memanggil API
            // Simulasi proses asinkron, misalnya memanggil API
            setTimeout(() => {
                this.isLoading = false; // Sembunyikan loader setelah proses selesai
            }, 2000); // Misalkan proses selesai dalam 2 detik

        }
    }">
        <!-- Loader -->
        <x-loader x-show="isLoading">testing</x-loader> <!-- Sesuaikan dengan elemen loader Anda -->
        
        <div class="relative z-50">
            <!-- Input Pencarian -->
            <input
                x-model="search"
                @click="open = true"
                @keydown.escape="open = false"
                class="border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"
                placeholder="Search {{$data['text']}} ..."
            >
            <!-- Dropdown Opsi -->
            <div
                x-show="open"
                @click.away="open = false"
                class="absolute z-50 overflow-auto w-full bg-white mt-1 rounded-md shadow-lg"
                style="max-height: 240px;"
            >
                <ul class="max-h-60 text-slate-600 dark:text-white">
                    @foreach ($data['options'] as $key => $value)
                        <!-- Hanya tampilkan opsi yang cocok dengan pencarian -->
                        <li
                            x-show="search === '' || '{{ $value }}'.toLowerCase().includes(search.toLowerCase())"
                            @click="selected = '{{ $key }}'; search = '{{ $value }}'; open = false;"
                            class="cursor-pointer p-2 hover:bg-gray-100 text-slate-600"
                        >{{ $value }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    
        <!-- Hidden Input untuk menyimpan nilai yang dipilih -->
        <input type="hidden" x-model="selected">
    </div>
    @error('form.'.$data['name'])
        <span class="text-danger">{{ str_replace('_', ' ', ucfirst($data['name'])) }} {{ $message }}</span>
    @enderror
</div> --}}

