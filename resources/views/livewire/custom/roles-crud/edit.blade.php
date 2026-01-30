<div>
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
    <div class="grid grid-cols-12 gap-x-6">
        <div class="xl:col-span-12 lg:col-span-12 md:col-span-12 sm:col-span-12 col-span-12">
            <div class="box p-4">
                <div class="flex flex-col lg:flex-row justify-between mb-4">
                    <h2 class="text-2xl font-semibold">Edit Role</h2>
                    {{-- <a href="{{ route('roles.index') }}"
                        class="inline-block bg-blue-500 text-white py-2 px-4 rounded">Back</a> --}}
                </div>

                @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form wire:submit="updateRole">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="role-name">
                                Name:
                            </label>
                            <input wire:model.live="role.name"
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="role-name" type="text" placeholder="Name">
                        </div>

                        <div class="w-full px-3">
                            <strong
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mt-2 mb-2">Permission:</strong>
                            @foreach ($this->permissionsParent as $parent)
                            <h3 class="my-2 font-semibold text-gray-900 text-base dark:text-white">{{$parent['name']}}</h3>
                            <ul
                                class="grid sm:grid-cols-4 grid-cols-2 gap-2 text-sm font-medium text-gray-900 bg-green-100 border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                @foreach ($this->permissionsChild->filter(function ($item) use($parent) {
                                return false !== stripos($item['name'], $parent['name']);
                                }) as $child)
                                <li
                                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center px-3">
                                        <input wire:model.live="rolePermissions" type="checkbox" value="{{$child['id']}}"
                                            class="w-4 h-4 text-blue-600 bg-white border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$child['name']}}</label>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @endforeach
                        </div>
                    </div>

                </form>
                <div class="flex justify-center">
                    <x-btn-warning wire:click="updateRole" class="flex items-center">
                        <span wire:loading.remove wire:target="updateRole">
                            @svg('bx-save', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
                        </span>
                        <x-loader wire:loading wire:target="updateRole"></x-loader>
                        <span class="hidden sm:inline-flex">Update</span>
                    </x-btn-warning>
                    <x-btn-secondary wire:click="cancelModal" class="flex items-center">
                        <span wire:loading.remove wire:target="cancelModal">
                            @svg('bx-arrow-back', ['class' => 'w-4 h-4 sm:mr-2 inline-flex align-text-bottom'])
                        </span>
                        <x-loader wire:loading wire:target="cancelModal"></x-loader>
                        <span class="hidden sm:inline-flex">Back</span>
                    </x-btn-secondary>
                </div>
            </div>
        </div>
    </div>

</div>