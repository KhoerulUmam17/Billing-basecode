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

    <div class="box p-4">
        <form action="{{route('contacts-store')}}" method="POST" wire:key='create-form'>
            @csrf
            <div @class([ 'grid sm:grid-cols-1'=> $this->formColumn === 1,
                'grid sm:grid-cols-2 sm:gap-6' => $this->formColumn === 2,
                ])>

                {{-- @foreach ($this->fields() as $index => $field)
                @if (in_array('form-create', $field['data']['hide']))
                    @continue
                @endif
                @include('components.fields.'.$field['type'], ['type' => $field['type'], 'data' => $field['data'],
                'modal' => 'create'])
                @endforeach --}}

                <div class="w-full mb-6">
                    <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                        Name 
                        <span class="text-danger"> *</span>
                    </label>
                    <input 
                        type="text" id="name" name="name"
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
                        type="text" id="mobile_phone" name="mobile_phone"
                        class="@error('mobile_phone') is-invalid @enderror border-sky-100 form-control"
                        placeholder="Mobile Phone" required>
                    @error('mobile_phone')
                        <span class="text-danger">{{ str_replace('_', ' ', ucfirst('mobile_phone')) }} {{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full mb-6">
                    <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                        Email Address 
                        <span class="text-danger"> *</span>
                    </label>
                    <input 
                        type="text" id="email" name="email"
                        class="@error('email') is-invalid @enderror border-sky-100 form-control"
                        placeholder="Email" required>
                    @error('email')
                        <span class="text-danger">{{ str_replace('_', ' ', ucfirst('email')) }} {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block uppercase text-slate-600 text-xs font-bold mb-2">
                        Job Title
                        <span class="text-danger"> *</span>
                    </label>
                    <select name="job_title" id="job_title"
                        class="@error('job_title') is-invalid @enderror js-example-basic-single border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                        <option value="null">{{ __('Please select') }}</option>
                        {{-- @foreach ($data['options'] as $key => $value)
                            <option value="{{ $key }}" wire:key="{{$data['name']}}-{{ $key }}">
                                {{ $value }}</option>
                        @endforeach --}}
                    </select>
                    @error('job_title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full mb-6">
                    <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                        Perusahaan
                    </label>
                    <input 
                        type="text" id="perusahaan" name="perusahaan"
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
                    <textarea name="address" id="address" placeholder="Address" class="form-control"></textarea>
                    @error('address')
                        <span class="text-danger">{{ str_replace('_', ' ', ucfirst('address')) }} {{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full mb-6">
                    <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
                        City
                    </label>
                    <input 
                        type="text" id="city" name="city"
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
                        type="text" id="state" name="state"
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
                        type="text" id="postal_code" name="postal_code"
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
                        type="text" id="country" name="country"
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
                    <textarea name="description" class="form-control" id="description" placeholder="Description"></textarea>
                    @error('description')
                        <span class="text-danger">{{ str_replace('_', ' ', ucfirst('description')) }} {{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block uppercase text-slate-600 text-xs font-bold mb-2">
                        Status
                        <span class="text-danger"> *</span>
                    </label>
                    <select name="status" id="status"
                        class="@error('status') is-invalid @enderror js-example-basic-single border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                        <option value="null">{{ __('Please select') }}</option>
                        {{-- @foreach ($data['options'] as $key => $value)
                            <option value="{{ $key }}" wire:key="{{$data['name']}}-{{ $key }}">
                                {{ $value }}</option>
                        @endforeach --}}
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block uppercase text-slate-600 text-xs font-bold mb-2">
                        Assigned To
                        <span class="text-danger"> *</span>
                    </label>
                    <select name="assigned_to" id="assigned_to"
                        class="@error('assigned_to') is-invalid @enderror js-example-basic-single border-0 px-3 py-3 placeholder-slate-400 text-slate-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                        <option value="null">{{ __('Please select') }}</option>
                        {{-- @foreach ($data['options'] as $key => $value)
                            <option value="{{ $key }}" wire:key="{{$data['name']}}-{{ $key }}">
                                {{ $value }}</option>
                        @endforeach --}}
                    </select>
                    @error('assigned_to')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
                <x-btn-primary wire:click="store">
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
    </div>

    @section('scripts')
        <!-- Jquery Cdn -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

        <!-- Select2 Cdn -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Internal Select-2.js -->
        @vite('resources/assets/js/select2.js')    
        
 
    @endsection
</div>