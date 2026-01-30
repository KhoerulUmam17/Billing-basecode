<!-- Start::page-header -->
<div>

    <div class="md:flex block items-center justify-between my-[1.5rem] page-header-breadcrumb">
        <div>
            <p class="font-semibold text-[1.125rem] text-defaulttextcolor dark:text-defaulttextcolor/70 !mb-0 ">
                {{__('dashboard.welcome')}}, {{auth()->user()->name}} !</p>
        </div>
    </div>
    <!-- End::page-header -->
    
    <div class="grid grid-cols-12 gap-x-6">
        <div class="xxl:col-span-12 xl:col-span-12 col-span-12">
            <div class="grid grid-cols-12 gap-x-6">
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
                                    @foreach (auth()->user()->actions()->orderBy('id', 'desc')->limit(8)->get() as $item)
                                        @if ($item->log_name == 'login')    
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
                                                        <span class="font-semibold ">{{$item->log_name}}, 
                                                            </span><span class="text-success font-semibold">
                                                                {{$item->description}}.</span>
                                                    </div>
                                                    <div class="flex-grow text-end">
                                                        <span
                                                            class="block text-[#8c9097] dark:text-white/50 text-[0.6875rem] opacity-[0.7]">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i A')}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @elseif ($item->log_name == 'logout')
                                            <li class="crm-recent-activity-content">
                                                <div class="flex items-start">
                                                    <div class="me-4">
                                                        <span
                                                            class="w-[1.25rem] h-[1.25rem] inline-flex items-center justify-center font-medium leading-[1.25rem] text-[0.65rem] 
                                                                text-danger bg-danger/10 rounded-full">
                                                            <i class="bi bi-circle-fill text-[0.5rem]"></i>
                                                        </span>
                                                    </div>
                                                    <div class="crm-timeline-content text-defaultsize">
                                                        <span class="font-semibold ">{{$item->log_name}}, 
                                                            </span><span class="text-danger font-semibold">
                                                                {{$item->description}}.</span>
                                                    </div>
                                                    <div class="flex-grow text-end">
                                                        <span
                                                            class="block text-[#8c9097] dark:text-white/50 text-[0.6875rem] opacity-[0.7]">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i A')}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @elseif ($item->log_name == 'groups')
                                            <li class="crm-recent-activity-content">
                                                <div class="flex items-start">
                                                    <div class="me-4">
                                                        <span
                                                            class="w-[1.25rem] h-[1.25rem] inline-flex items-center justify-center font-medium leading-[1.25rem] text-[0.65rem] 
                                                                text-warning bg-warning/10 rounded-full">
                                                            <i class="bi bi-circle-fill text-[0.5rem]"></i>
                                                        </span>
                                                    </div>
                                                    <div class="crm-timeline-content text-defaultsize">
                                                        <span class="font-semibold ">{{$item->log_name}}, 
                                                            </span><span class="text-warning font-semibold">
                                                                {{$item->description}} data.</span>
                                                    </div>
                                                    <div class="flex-grow text-end">
                                                        <span
                                                            class="block text-[#8c9097] dark:text-white/50 text-[0.6875rem] opacity-[0.7]">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i A')}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @elseif ($item->log_name == 'contacts')
                                            <li class="crm-recent-activity-content">
                                                <div class="flex items-start">
                                                    <div class="me-4">
                                                        <span
                                                            class="w-[1.25rem] h-[1.25rem] inline-flex items-center justify-center font-medium leading-[1.25rem] text-[0.65rem] 
                                                                text-purple bg-purple/10 rounded-full">
                                                            <i class="bi bi-circle-fill text-[0.5rem]"></i>
                                                        </span>
                                                    </div>
                                                    <div class="crm-timeline-content text-defaultsize">
                                                        <span class="font-semibold ">{{$item->log_name}}, 
                                                            </span><span class="text-purple font-semibold">
                                                                {{$item->description}} data </span><span class="font-semibold">{{$item->properties['attributes']['name'] ?? ''}}</span>
                                                    </div>
                                                    <div class="flex-grow text-end">
                                                        <span
                                                            class="block text-[#8c9097] dark:text-white/50 text-[0.6875rem] opacity-[0.7]">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i A')}}</span>
                                                    </div>
                                                </div>
                                            </li>
                                        @elseif ($item->log_name == 'leads')
                                            <li class="crm-recent-activity-content">
                                                <div class="flex items-start">
                                                    <div class="me-4">
                                                        <span
                                                            class="w-[1.25rem] h-[1.25rem] inline-flex items-center justify-center font-medium leading-[1.25rem] text-[0.65rem] 
                                                                text-indigo bg-indigo/10 rounded-full">
                                                            <i class="bi bi-circle-fill text-[0.5rem]"></i>
                                                        </span>
                                                    </div>
                                                    <div class="crm-timeline-content text-defaultsize">
                                                        <span class="font-semibold ">{{$item->log_name}}, 
                                                            </span><span class="text-indigo font-semibold">
                                                                {{$item->description}} data </span><span class="font-semibold">{{$item->properties['attributes']['name'] ?? ''}}</span>
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
        </div>

    </div>
    
    <!-- JSVector Maps JS -->
    <script src="{{asset('build/assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    
    <!-- JSVector Maps MapsJS -->
    <script src="{{asset('build/assets/libs/jsvectormap/maps/world-merc.js')}}"></script>
    
    <!-- Apex Charts JS -->
    <script src="{{asset('build/assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    
    <!-- Chartjs Chart JS -->
    <script src="{{asset('build/assets/libs/chart.js/chart.min.js')}}"></script>
    
    <!-- CRM-Dashboard -->
    @vite('resources/assets/js/crm-dashboard.js')

    <script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>
    
    <script>
        const driver = window.driver.js.driver;

        const driverObj = driver({
        showProgress: true,
        showButtons: [
            'next',
            'previous',
            'close'
        ],
        steps: [
            {popover: { title: "{{__('guide.dashboard.step.1.title')}}", description: "{{__('guide.dashboard.step.1.description')}}", side: "buttom", align: 'start' }},
            {element: '.main-header', popover: { title: "{{__('guide.dashboard.step.2.title')}}", description: "{{__('guide.dashboard.step.2.description')}}", side: "buttom", align: 'start' }},
            {element: '#dropdown-flag', popover: { title: "{{__('guide.dashboard.step.3.title')}}", description: "{{__('guide.dashboard.step.3.description')}}", side: "buttom", align: 'start' }},
            {element: '.hs-dark-mode', popover: { title: "{{__('guide.dashboard.step.4.title')}}", description: "{{__('guide.dashboard.step.4.description')}}", side: "buttom", align: 'start' }},
            {element: '#dropdown-profile', popover: { title: "{{__('guide.dashboard.step.5.title')}}", description: "{{__('guide.dashboard.step.5.description')}}", side: "buttom", align: 'center' }},
            {element: '.main-sidebar', popover: { title: "{{__('guide.dashboard.step.6.title')}}", description: "{{__('guide.dashboard.step.6.description')}}", side: "buttom", align: 'center' }},
            {popover: { title: "{{__('guide.dashboard.step.7.title')}}", description: "{{__('guide.dashboard.step.7.description')}}", side: "buttom", align: 'start' }},
        ]
        });

            // Cek Local Storage untuk melihat apakah guide sudah ditampilkan
        if (!localStorage.getItem("guideShownDashboard")) {
            driverObj.drive();
            localStorage.setItem("guideShownDashboard", "true"); // Tandai guide sebagai ditampilkan
        }
    </script>
</div>

