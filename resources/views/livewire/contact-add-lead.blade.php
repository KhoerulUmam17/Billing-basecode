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
        @can('contacts.addleads')
            <form wire:submit='store' wire:key='create-leads-form'>
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
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('name')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Mobile Phone 
                            <span class="text-danger"> *</span>
                        </label>
                        <input 
                            type="text" id="phone" name="phone" wire:model.blur='phone'
                            class="@error('mobile_phone') is-invalid @enderror border-sky-100 form-control"
                            placeholder="Mobile Phone" required>
                        @error('mobile_phone')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('mobile_phone')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Whatsapp Number
                        </label>
                        <input 
                            type="text" id="wa_number" name="wa_number" wire:model.blur='wa_number'
                            class="@error('wa_number') is-invalid @enderror border-sky-100 form-control"
                            placeholder="Whatsapp Number">
                        @error('wa_number')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('wa_number')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Email Address
                        </label>
                        <input 
                            type="text" id="email" name="email" wire:model.blur='email'
                            class="@error('email') is-invalid @enderror border-sky-100 form-control"
                            placeholder="Email" required>
                        @error('email')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('email')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <div wire:ignore>
                            <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                                Job Title
                                <span class="text-danger"> *</span>
                            </label>
                            <select name="job_title" id="job_title" wire:model.blur='job_title'
                                class="@error('job_title') is-invalid @enderror js-example-basic-single border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                <option value="">{{ __('Please select') }}</option>
                                @foreach ($this->jobTitleOptions as $key => $value)
                                    <option value="{{ $key }}" wire:key="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @error('job_title')
                                <span class="text-danger">{{ str_replace('_', ' ', ucfirst('job_title')) }} {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Perusahaan
                        </label>
                        <input 
                            type="text" id="perusahaan" name="perusahaan" wire:model.blur='perusahaan'
                            class="@error('perusahaan') is-invalid @enderror border-sky-100 form-control"
                            placeholder="Perusahaan">
                        @error('perusahaan')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('perusahaan')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Alamat
                        </label>
                        <textarea wire:model.blur='address' name="address" id="address" placeholder="Address" class="form-control"></textarea>
                        @error('address')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('address')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            City
                        </label>
                        <input 
                            type="text" id="city" name="city" wire:model.blur='city'
                            class="@error('city') is-invalid @enderror border-sky-100 form-control"
                            placeholder="city">
                        @error('city')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('city')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            State / Province
                        </label>
                        <input 
                            type="text" id="state" name="state" wire:model.blur='state'
                            class="@error('state') is-invalid @enderror border-sky-100 form-control"
                            placeholder="state">
                        @error('state')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('state')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Postal Code
                        </label>
                        <input 
                            type="text" id="postal_code" name="postal_code" wire:model.blur='postal_code'
                            class="@error('postal_code') is-invalid @enderror border-sky-100 form-control"
                            placeholder="postal_code">
                        @error('postal_code')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('postal_code')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Country
                        </label>
                        <input 
                            type="text" id="country" name="country" wire:model.blur='country'
                            class="@error('country') is-invalid @enderror border-sky-100 form-control"
                            placeholder="country">
                        @error('country')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('country')) }} {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full mb-6">
                        <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                            Description
                        </label>
                        <textarea wire:model.blur='description' name="description" class="form-control" id="description" placeholder="Description"></textarea>
                        @error('description')
                            <span class="text-danger">{{ str_replace('_', ' ', ucfirst('description')) }} {{ $message }}</span>
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
                                <span class="text-danger">{{ str_replace('_', ' ', ucfirst('status')) }} {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                        <div class="mb-6">
                            <div wire:ignore>
                                <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                                    Assigned To
                                    <span class="text-danger"> *</span>
                                </label>
                                <select name="assigned_to" id="assigned_to" wire:model.blur='assigned_to'
                                    class="@error('assigned_to') is-invalid @enderror js-example-basic-single border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    <option value="">{{ __('Please select') }}</option>
                                    @foreach ($this->assignedOptions as $key => $value)
                                        <option value="{{ $key }}" wire:key="{{ $key }}">
                                            {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                @error('assigned_to')
                                    <span class="text-danger">{{ str_replace('_', ' ', ucfirst('assigned_to')) }} {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
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
                    <x-btn-primary wire:click="store" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="store">
                            @svg('bx-save', ['class' => 'w-4 h-4 sm:mr-2 flex'])
                        </span>
                        <x-loader wire:loading wire:target="store"></x-loader>
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
                $('#job_title').select2();
                $('#job_title').on('change', function (e) {
                    @this.set('job_title', e.target.value);
                });
        
                // Inisialisasi Select2 untuk dropdown kedua
                $('#status').select2();
                $('#status').on('change', function (e) {
                    @this.set('status', e.target.value);
                });

                $('#assigned_to').select2();
                $('#assigned_to').on('change', function (e) {
                    @this.set('assigned_to', e.target.value);
                });
            });

        </script>
        
 
    @endsection
</div>