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

    <!-- Start::row-1 -->
    <div class="box custom-box">
        <div class="box-body">
            <div class="sm:flex align-top justify-between">
                <div>
                    <div class="flex">
                        <div>
                            <h4 class="font-bold mb-4 flex items-center sm:items-baseline">
                                <a href="javascript:void(0);">{{$name}}</a>
                                <span class="popular-tags mb-2 sm:mb-0 ml-2 flex align-middle">
                                    <span href="javascript:void(0);" class="badge !rounded-full bg-info/10 text-info">
                                        <i class='bx bx-stats mr-2'></i>
                                        {{$status}}
                                    </span>
                                </span>
                            </h4>
                            <div class="table-responsive">
                                <table class="table whitespace-nowrap min-w-full">
                                    <tbody>
                                        <tr class="border-b border-defaultborder">
                                            <th scope="row" class="text-start">Email</th>
                                            <td><input class="form-control" type="text" value="{{$email}}" disabled></td>
                                            <th scope="row" class="text-start">Job Title</th>
                                            <td><input class="form-control" type="text" value="{{$job_title}}" disabled></td>
                                        </tr>
                                        <tr class="border-b border-defaultborder">
                                            <th scope="row" class="text-start">Address</th>
                                            <td>
                                                <textarea class="form-control" disabled>{{$address}}</textarea>
                                            </td>
                                            <th scope="row" class="text-start">Postal Code</th>
                                            <td><input class="form-control" type="text" value="{{$postal_code}}" disabled></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="btn-list flex sm:block items-center mb-2 mt-4 sm:mt-0 justify-center">
                        <span>
                            <a aria-label="anchor" href="https://wa.me/{{$wa_number}}" target="_blank" class="ti-btn ti-btn-icon ti-btn-primary-full">
                                <i class="ri-phone-line"></i>
                            </a>
                        </span>
                        <span>
                            <a aria-label="anchor" href="{{route('contacts-view', $contacts_id)}}" target="_blank" class="ti-btn ti-btn-icon ti-btn-secondary-full">
                                <i class="ri-eye-line"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-6 xl:col-span-6 lg:col-span-12 col-span-12">
            <!--End::row-1 -->
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-title">Description</div>
                </div>
                <div class="box-body">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12">
                            <textarea disabled class="form-control" cols="10" rows="5">{{$description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="xxl:col-span-6 xl:col-span-6 lg:col-span-12 col-span-12">
            <div class="box custom-box">
                <div class="box-header">
                    <div class="box-title">Groups</div>
                </div>
                <div class="box-body">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12">
                            @foreach ($this->group as $item)
                                <div class="flex">
                                    - {{$item->name}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="xxl:col-span-12 xl:col-span-12 col-span-12">
        <div class="box">
            <div class="box-header justify-between">
                <div class="box-title">
                    {{__('dashboard.recent')}}
                </div>
            </div>
            <div class="box-body">
                <div>
                    <ul class="list-none mb-0 crm-recent-activity">
                        {{-- {{dd($this->activity)}} --}}
                        @foreach ($this->activity as $item)
                            @if ($item->event == 'created')    
                                <li class="crm-recent-activity-content">
                                    <div class="flex items-start">
                                        <div class="me-4">
                                            <span
                                                class="w-[1.25rem] h-[1.25rem] inline-flex items-center justify-center font-medium leading-[1.25rem] text-[0.65rem] 
                                                    text-success bg-success/10 rounded-full">
                                                <i class="bi bi-circle-fill text-[0.5rem]"></i>
                                            </span>
                                        </div>
                                        <div class="crm-timeline-content text-defaultsize">
                                            <span class="font-semibold">
                                                {{$item->log_name}}, 
                                            </span>
                                            <span class="text-success font-semibold">
                                                {{$item->description}}
                                            </span>
                                            by
                                            <span class="font-semibold rounded-sm text-primary text-[0.75em] bg-primary/10">
                                                @ {{$item->causer->name}}
                                            </span>
                                        </div>
                                        <div class="flex-grow text-end">
                                            <span
                                                class="block text-[#8c9097] dark:text-white/50 text-[0.6875rem] opacity-[0.7]">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i A')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @elseif ($item->event == 'updated')
                                <li class="crm-recent-activity-content">
                                    <div class="flex items-start">
                                        <div class="me-4">
                                            <span
                                                class="w-[1.25rem] h-[1.25rem] inline-flex items-center justify-center font-medium leading-[1.25rem] text-[0.65rem] 
                                                    text-yellow bg-yellow/10 rounded-full">
                                                <i class="bi bi-circle-fill text-[0.5rem]"></i>
                                            </span>
                                        </div>
                                        <div class="crm-timeline-content text-defaultsize">
                                            <span class="font-semibold ">
                                                {{$item->log_name}}, 
                                            </span>
                                            <span class="text-yellow font-semibold">
                                                {{$item->description}}.
                                            </span>
                                            by
                                            <span class="font-semibold rounded-sm text-primary text-[0.75em] bg-primary/10">
                                                @ {{$item->causer->name}}
                                            </span>
                                        </div>
                                        <div class="flex-grow text-end">
                                            <span
                                                class="block text-[#8c9097] dark:text-white/50 text-[0.6875rem] opacity-[0.7]">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i A')}}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>