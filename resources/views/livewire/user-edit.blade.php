<div>
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    @endsection

    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
            <h3
                class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold">
                {{$this->title}}</h3>
        </div>
        <ol class="flex items-center whitespace-nowrap min-w-0">
            <li class="text-[0.813rem] ps-[0.5rem]">
                <a class="flex items-center text-primary hover:text-primary dark:text-primary truncate"
                    href="javascript:void(0);">
                    Menu
                    <i
                        class="ti ti-chevrons-right flex-shrink-0 text-[#8c9097] dark:text-white/50 px-[0.5rem] overflow-visible rtl:rotate-180"></i>
                </a>
            </li>
            <li class="text-[0.813rem] text-defaulttextcolor font-semibold hover:text-primary dark:text-[#8c9097] dark:text-white/50 "
                aria-current="page">
                {{$this->title}}
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    <div class="box p-10">
        @can('users.edit')
            <form wire:submit='store' wire:key='create-form'>
                @csrf
                <div @class([ 'grid sm:grid-cols-1'=> $this->formColumn === 1,
                    'grid sm:grid-cols-2 sm:gap-6' => $this->formColumn === 2,
                    ])>

                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Name 
                            <span class="text-danger"> *</span>
                        </label>
                        <input 
                            type="text" id="name" name="name" wire:model.blur='name'
                            class="@error('name') is-invalid @enderror border-sky-100 form-control"
                            placeholder="name" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            NIK
                            <span class="text-danger"> *</span>
                        </label>
                        <input maxlength='16'
                            type="text" id="nik" name="nik" wire:model.blur='nik'
                            class="@error('nik') is-invalid @enderror border-sky-100 form-control"
                            placeholder="NIK" required>
                        @error('nik')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Mobile Phone 
                            <span class="text-danger"> *</span>
                        </label>
                        <input maxlength='15'
                            type="text" id="mobile_phone" name="mobile_phone" wire:model.blur='mobile_phone'
                            class="@error('mobile_phone') is-invalid @enderror border-sky-100 form-control"
                            placeholder="Mobile Phone" required>
                        @error('mobile_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Username
                            <span class="text-danger"> *</span>
                        </label>
                        <input 
                            type="text" id="username" name="username" wire:model.blur='username'
                            class="@error('username') is-invalid @enderror border-sky-100 form-control"
                            placeholder="Username" required>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Email Address 
                            <span class="text-danger"> *</span>
                        </label>
                        <input 
                            type="email" id="email" name="email" wire:model.blur='email'
                            class="@error('email') is-invalid @enderror border-sky-100 form-control"
                            placeholder="Email" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <div wire:ignore>
                            <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                                Status
                                <span class="text-danger"> *</span>
                            </label>
                            <select name="status" id="status" wire:model.blur='status'
                                class="@error('status') is-invalid @enderror js-example-basic-single border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                <option value="">{{ __('Please select') }}</option>
                                @foreach ($this->statusOptions as $key => $value)
                                    <option value="{{ $key }}" wire:key="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-6">
                        <div wire:ignore>
                            <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                                Role
                                <span class="text-danger"> *</span>
                            </label>
                            <select name="role" id="role" wire:model.blur='role'
                                class="@error('role') is-invalid @enderror js-example-basic-single border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                <option value="">{{ __('Please select') }}</option>
                                @foreach ($this->roleOptions as $key => $value)
                                    <option value="{{ $key }}" wire:key="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-6">
                        <div wire:ignore>
                            <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                                Group
                                <span class="text-danger"> *</span>
                            </label>
                            <select name="group" id="group" wire:model.blur='group' multiple
                                class="@error('group') is-invalid @enderror js-example-placeholder-multiple js-states border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                <option value="">{{ __('Please select') }}</option>
                                @foreach ($this->groupOptions as $key => $value)
                                    <option value="{{ $key }}" wire:key="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @error('group')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <x-btn-danger wire:click="backToList">
                        <span wire:loading.remove wire:target="backToList">
                            @svg('bx-arrow-back', ['class' => 'w-4 h-4 sm:mr-2 flex'])
                        </span>
                        <x-loader wire:loading wire:target="backToList"></x-loader>
                        <span class="inline-flex">
                            Kembali
                        </span>
                    </x-btn-danger>
                    <x-btn-primary wire:click="update">
                        <span wire:loading.remove wire:target="update">
                            @svg('bx-save', ['class' => 'w-4 h-4 sm:mr-2 flex'])
                        </span>
                        <x-loader wire:loading wire:target="update"></x-loader>
                        <span class="inline-flex">
                            Simpan
                        </span>
                    </x-btn-primary>
                </div>
            </form>
        @else
            @include('errors.403')
        @endcan
    </div>

    @section('scripts')
        <!-- Jquery Cdn -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

        <!-- Select2 Cdn -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Internal Select-2.js -->
        @vite('resources/assets/js/select2.js')    

        <script>
            document.addEventListener('livewire:init', function () {
                // Inisialisasi Select2 untuk dropdown pertama
                $('#role').select2();
                $('#role').on('change', function (e) {
                    @this.set('role', e.target.value);
                });
        
                // Inisialisasi Select2 untuk dropdown kedua
                $('#status').select2();
                $('#status').on('change', function (e) {
                    @this.set('status', e.target.value);
                });

                $('#group').select2();
                $('#group').on('change', function (e) {
                    var data = $(this).val();
                    @this.set('group', data);
                });
            });

        </script>
        
 
    @endsection
</div>