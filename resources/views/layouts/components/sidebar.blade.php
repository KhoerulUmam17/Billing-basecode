<aside class="app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="{{url('index')}}" class="header-logo">
            <img src="{{asset('build/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo">
            <img src="{{asset('build/assets/images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo">
            <img src="{{asset('build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
            <img src="{{asset('build/assets/images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark">
            {{-- <img src="{{asset('build/assets/images/brand-logos/desktop-white.png')}}" alt="logo"
                class="desktop-white">
            <img src="{{asset('build/assets/images/brand-logos/toggle-white.png')}}" alt="logo" class="toggle-white">
            --}}
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg></div>
            <ul class="main-menu">
                @if(is_array(config('menu')))
                    @foreach (config('menu') as $menu)
                        @if (auth()->user()->hasPermissionTo($menu['permissions']) || auth()->user()->hasRole('superadmin'))
                            <!-- Start::slide__category -->
                            <li class="slide__category"><span class="category-name">{{$menu['header']}}</span></li>
                            <!-- End::slide__category -->
                        @endif

                        <!-- Navigation -->
                        @foreach ($menu['menu'] as $item)
                            @if (auth()->user()->hasPermissionTo($item['permissions']) || auth()->user()->hasRole('superadmin'))
                                <li class="slide {{$item['have-menu'] ? 'has-sub' : ''}}">
                                    <a href="{{!$item['have-menu'] ? route($item['route']) : 'javascript:void(0);'}}" class="side-menu__item">
                                        <i class="bx {{$item['icon']}} side-menu__icon"></i>
                                        <span class="side-menu__label">{{$item['text']}}</span>
                                        @if ($item['have-menu'])
                                            <i class="fe fe-chevron-right side-menu__angle"></i>
                                        @endif
                                    </a>
                                    @if ($item['have-menu'])
                                        <ul class="slide-menu child1">
                                            <li class="slide">
                                                <a href="{{route($item['route'])}}" class="side-menu__item">{{__('feature.feature.list')}} {{$item['text']}}</a>
                                            </li>
                                            @foreach ($item['submenu'] as $submenu)
                                                @if (auth()->user()->hasPermissionTo($submenu['permissions']) || auth()->user()->hasRole('superadmin'))
                                                    <li class="slide">
                                                        <a href="{{route($submenu['route'])}}" class="side-menu__item">{{$submenu['text']}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @else
                                @continue
                            @endif
                        @endforeach
                    @endforeach
                @else
                    <li><span class="text-gray-400 px-4 py-2 block">Menu belum tersedia</span></li>
                @endif
                {{--
                @if (!$loop->last)
                    <hr class="my-4 md:min-w-full" />
                @endif
                --}}

                {{--
                <!-- Start::slide -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboards<span
                                class="badge !bg-warning/10 !text-warning !py-[0.25rem] !px-[0.45rem] !text-[0.75em] ms-2">12</span></span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Dashboards</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index')}}" class="side-menu__item">CRM</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index2')}}" class="side-menu__item">Ecommerce</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index3')}}" class="side-menu__item">Crypto</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index4')}}" class="side-menu__item">Jobs</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index5')}}" class="side-menu__item">NFT</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index6')}}" class="side-menu__item">Sales</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index7')}}" class="side-menu__item">Analytics</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index8')}}" class="side-menu__item">Projects</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index9')}}" class="side-menu__item">HRM</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index10')}}" class="side-menu__item">Stocks</a>
                        </li>
                        <li class="slide">
                            <a href="{{url('index11')}}" class="side-menu__item">Courses</a>
                        </li>

                        <li class="slide">
                            <a href="{{url('index12')}}" class="side-menu__item">Personal</a>
                        </li>
                    </ul>
                </li> --}}
                <!-- End::slide -->


                <!-- Start::slide -->
                {{-- <li class="slide">
                    <a href="{{url('widgets')}}" class="side-menu__item">
                        <i class="bx bx-gift side-menu__icon"></i>
                        <span class="side-menu__label">Widgets <span
                                class="text-danger text-[0.75em] rounded-sm badge !py-[0.25rem] !px-[0.45rem] !bg-danger/10 ms-2">Hot</span></span>
                    </a>
                </li> --}}
                <!-- End::slide -->
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>