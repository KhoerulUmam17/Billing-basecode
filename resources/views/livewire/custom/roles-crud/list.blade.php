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
            <div class="block w-full overflow-x-auto">
                <!-- Projects table -->
                <x-table>
                    <x-slot name="thead">
                        <tr>
                            <x-table-th>
                                No
                            </x-table-th>
                            <x-table-th>
                                Name
                            </x-table-th>
                            <x-table-th>
                                Aksi
                            </x-table-th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($roles as $index => $role)
                        <x-table-body-tr>
                            <x-table-td>
                                {{$index + 1}}
                            </x-table-td>
                            <x-table-td>
                                {{$role->name}}
                            </x-table-td>
                            <x-table-td>
                                <div class="flex">
                                    <x-btn-warning wire:click="edit({{ $role->id }})" class="flex items-center">
                                        <span wire:loading.remove wire:target="edit({{ $role->id }})">
                                            @svg('bx-edit', ['class' => 'w-4 h-4 sm:mr-2 inline-flex
                                            align-text-bottom'])
                                        </span>
                                        <x-loader wire:loading wire:target="edit({{ $role->id }})"></x-loader>
                                        <span class="hidden sm:inline-flex">Edit</span>
                                    </x-btn-warning>
                                    {{-- <x-btn-danger wire:click="confirmDelete({{ $role->id }})"
                                        class="flex items-center">
                                        <span wire:loading.remove wire:target="confirmDelete({{ $role->id }})">
                                            @svg('bx-trash', ['class' => 'w-4 h-4 sm:mr-2 inline-flex
                                            align-text-bottom'])
                                        </span>
                                        <x-loader wire:loading wire:target="confirmDelete({{ $role->id }})"></x-loader>
                                        <span class="hidden sm:inline-flex">Delete</span>
                                    </x-btn-danger> --}}
                                </div>
                            </x-table-td>
                        </x-table-body-tr>
                        @endforeach
                    </x-slot>
                </x-table>
                {{$roles->links()}}
            </div>
        </div>
    </div>
</div>