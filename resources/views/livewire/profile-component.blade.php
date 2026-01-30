<div>
    @section('styles')
        <!-- Glightbox CSS -->
        <link rel="stylesheet" href="{{asset('build/assets/libs/glightbox/css/glightbox.min.css')}}">
    @endsection

    <!-- Page Header -->
    <div class="block justify-between page-header md:flex">
        <div>
            <h3 class="!text-defaulttextcolor dark:!text-defaulttextcolor/70 dark:text-white dark:hover:text-white text-[1.125rem] font-semibold"> Profile</h3>
        </div>
        <ol class="flex items-center whitespace-nowrap min-w-0">
            <li class="text-[0.813rem] ps-[0.5rem]">
            <a class="flex items-center text-primary hover:text-primary dark:text-primary truncate" href="javascript:void(0);">
                Menu
                <i class="ti ti-chevrons-right flex-shrink-0 text-[#8c9097] dark:text-white/50 px-[0.5rem] overflow-visible rtl:rotate-180"></i>
            </a>
            </li>
            <li class="text-[0.813rem] text-defaulttextcolor font-semibold hover:text-primary dark:text-[#8c9097] dark:text-white/50 " aria-current="page">
                Profile
            </li>
        </ol>
    </div>
    <!-- Page Header Close -->

    <div class="grid grid-cols-6 gap-x-4">
        <div class="col-start-2 xxl:col-span-12 xl:col-span-12 col-span-12">
            <div class="box overflow-hidden">
                <div class="box-body !p-0">
                    <div class="sm:flex items-start p-6 main-profile-cover">
                        <div>
                            <div class="relative mr-4 items-center">
                                <span class="avatar avatar-xxl avatar-rounded online me-4">
                                    @if ($photo)
                                        <img src="{{ $photo->temporaryUrl() }}"> <!-- Menampilkan pratinjau gambar -->
                                    @elseif (!empty(auth()->user()->photo))
                                        <img src="{{ Storage::url(auth()->user()->photo) }}" alt="">
                                    @else
                                        <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="">
                                    @endif
                                </span>
                                @if ($this->modeEditPhoto)
                                    <div class="flex items-center !justify-between">
                                        <input type="file" wire:model.live='photo' class="block w-full border border-gray-200 focus:shadow-sm dark:focus:shadow-white/10 rounded-sm text-sm focus:z-10 focus:outline-0 focus:border-gray-200 dark:focus:border-white/10 dark:border-white/10 dark:text-[#8c9097] dark:text-white/50
                                        file:me-4 file:py-2 file:px-4
                                        file:rounded-s-sm file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-primary file:text-white
                                        hover:file:bg-primary focus-visible:outline-none
                                    ">
                                    </div>
                                    @error('photo')
                                        <span class="text-danger block">{{ $message }}</span>
                                    @enderror
                                    <button wire:click='save' class="ti-btn ti-btn-light !font-normal mt-3 !gap-0">
                                        <i wire:loading.remove wire:target='save' class="ri-save-2-fill me-1 align-middle inline-block"></i>
                                        <x-loader wire:loading wire:target="save" class="text-gray-800"></x-loader>
                                        Simpan
                                    </button>
                                    <button wire:click='cancel' class="ti-btn ti-btn-danger-full !font-normal mt-3 !gap-0">
                                        <i wire:loading.remove wire:target='cancel' class="ri-close-circle-fill me-1 align-middle inline-block"></i>
                                        <x-loader wire:loading wire:target="cancel" class="text-gray-800"></x-loader>
                                        Cancel
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="flex-grow main-profile-info">
                            <div class="flex items-center !justify-between">
                                <h6 class="font-semibold mb-1 text-white text-[1rem]">{{auth()->user()->name}}</h6>
                                <button wire:click='toggleModeEdit' class="ti-btn ti-btn-light !font-medium !gap-0">
                                    <i wire:loading.remove wire:target='toggleModeEdit' class="ri-edit-2-fill me-1 align-middle inline-block"></i>
                                    <x-loader wire:loading wire:target="toggleModeEdit" class="text-gray-800"></x-loader>
                                    Edit Photo
                                </button>
                            </div>
                            <p class="mb-1 !text-white  opacity-[0.7]">{{auth()->user()->username}}</p>
                        </div>
                    </div>
                    <div class="p-6 border-b border-dashed dark:border-defaultborder/10">
                        <p class="text-[.9375rem] mb-2 me-6 font-semibold">
                            <span>Contact Information :</span>
                            @if ($this->modeEditContactInfo)
                                <button wire:click='saveMobile' class="ti-btn ti-btn-icon ti-btn-primary-full ti-btn-wave">
                                    <i wire:loading.remove wire:target='saveMobile' class="ri-save-2-fill align-middle inline-block"></i>
                                    <i wire:loading wire:target="saveMobile" class="ri-loader-2-fill text-[1rem] animate-spin"></i>
                                </button>
                                <button wire:click='cancel' class="ti-btn ti-btn-icon ti-btn-danger-full ti-btn-wave">
                                    <i wire:loading.remove wire:target='cancel' class="ri-close-circle-fill align-middle inline-block"></i>
                                    <i wire:loading wire:target="cancel" class="ri-loader-2-fill text-[1rem] animate-spin"></i>
                                </button>
                            @else
                                <span>
                                    <button wire:click='toggleModeEditMobile' class="ti-btn ti-btn-icon ti-btn-secondary-full ti-btn-wave">
                                        <i wire:loading.remove wire:target='toggleModeEditMobile' class="ri-edit-2-fill align-middle inline-block"></i>
                                        <i wire:loading wire:target="toggleModeEditMobile" class="ri-loader-2-fill text-[1rem] animate-spin"></i>
                                    </button>
                                </span>
                            @endif
                        </p>
                        <div class="text-[#8c9097] dark:text-gray-700">
                            <p class="mb-2">
                                <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-[#8c9097] dark:text-white/50">
                                    <i class="ri-mail-line align-middle text-[.875rem] text-[#8c9097] dark:text-white/50"></i>
                                </span>
                                {{auth()->user()->email}}
                            </p>
                            <p class="mb-2">
                                <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-[#8c9097] dark:text-white/50">
                                    <i class="ri-phone-line align-middle text-[.875rem] text-[#8c9097] dark:text-white/50"></i>
                                </span>
                                @if ($this->modeEditContactInfo)
                                    <input type="text" wire:model.live='mobile_phone' class="form-control-sm w-auto dark:text-gray-900" value="{{auth()->user()->mobile_phone}}">
                                    @error('mobile_phone')
                                        <span class="text-danger block">{{ $message }}</span>
                                    @enderror
                                @else
                                    {{auth()->user()->mobile_phone}}
                                @endif
                            </p>
                            <p class="mb-2">
                                <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-[#8c9097] dark:text-white/50">
                                    <i class="ri-file-user-fill align-middle text-[.875rem] text-[#8c9097] dark:text-white/50"></i>
                                </span>
                                @if ($this->modeEditContactInfo)
                                    <input type="text" wire:model.live='nik' class="form-control-sm w-auto dark:text-gray-900" value="{{auth()->user()->nik}}">
                                    @error('nik')
                                        <span class="text-danger block">{{ $message }}</span>
                                    @enderror
                                @else
                                    {{auth()->user()->nik}}
                                @endif
                            </p>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
        <div class="xxl:col-span-8 xl:col-span-12 col-span-12">
            <div class="grid grid-cols-12 gap-x-6">
                {{-- <div class="xl:col-span-12 col-span-12">
                    <div class="box">
                        <div class="box-body !p-0">
                            <div class="!p-4 border-b dark:border-defaultborder/10 border-dashed md:flex items-center justify-between">
                                <nav class="-mb-0.5 sm:flex md:space-x-6 rtl:space-x-reverse pb-2">
                                    <a class="w-full sm:w-auto flex active hs-tab-active:font-semibold  hs-tab-active:text-white hs-tab-active:bg-primary rounded-md py-2 px-4 text-primary text-sm" href="javascript:void(0);" id="activity-tab" data-hs-tab="#activity-tab-pane" aria-controls="activity-tab-pane">
                                        <i class="ri-gift-line  align-middle inline-block me-1"></i>Activity
                                    </a>
                                    <a class="w-full sm:w-auto flex hs-tab-active:font-semibold  hs-tab-active:text-white hs-tab-active:bg-primary rounded-md  py-2 px-4 text-primary text-sm" href="javascript:void(0);"  id="posts-tab" data-hs-tab="#posts-tab-pane" aria-controls="posts-tab-pane">
                                        <i class="ri-bill-line me-1 align-middle inline-block"></i>Posts
                                    </a>
                                    <a class="w-full sm:w-auto flex hs-tab-active:font-semibold  hs-tab-active:text-white hs-tab-active:bg-primary rounded-md  py-2 px-4 text-primary text-sm" href="javascript:void(0);" id="followers-tab" data-hs-tab="#followers-tab-pane" aria-controls="followers-tab-pane">
                                        <i class="ri-money-dollar-box-line me-1 align-middle inline-block"></i>Friends
                                    </a>
                                    <a class="w-full sm:w-auto flex hs-tab-active:font-semibold  hs-tab-active:text-white hs-tab-active:bg-primary rounded-md  py-2 px-4 text-primary text-sm" href="javascript:void(0);" id="gallery-tab" data-hs-tab="#gallery-tab-pane" aria-controls="gallery-tab-pane">
                                        <i class="ri-exchange-box-line me-1 align-middle inline-block"></i>Gallery
                                    </a>
                                </nav>
                                <div>
                                    <p class="font-semibold mb-2">Profile 60% completed - <a href="javascript:void(0);" class="text-primary text-[0.75rem]">Finish now</a></p>
                                    <div class="progress progress-xs progress-animate">
                                        <div class="progress-bar bg-primary w-[60%]" ></div>
                                    </div>
                                </div>
                            </div>
                            <div class="!p-4">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane show active fade !p-0 !border-0" id="activity-tab-pane"
                                        role="tabpanel" aria-labelledby="activity-tab" tabindex="0">
                                        <ul class="list-none profile-timeline">
                                            <li>
                                                <div>
                                                    <span class="avatar avatar-sm bg-primary/10  !text-primary avatar-rounded profile-timeline-avatar">
                                                        E
                                                    </span>
                                                    <p class="mb-2">
                                                        <b>You</b> Commented on <b>alexander taylor</b> post <a class="text-secondary" href="javascript:void(0);"><u>#beautiful day</u></a>.<span class="ltr:float-right rtl:float-left text-[.6875rem] text-[#8c9097] dark:text-white/50">24,Dec 2022 - 14:34</span>
                                                    </p>
                                                    <p class="profile-activity-media mb-0 flex w-full mt-2 sm:mt-0">
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/media-17.jpg')}}" alt="">
                                                        </a>
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/media-18.jpg')}}" alt="">
                                                        </a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <span class="avatar avatar-sm avatar-rounded profile-timeline-avatar">
                                                        <img src="{{asset('build/assets/images/faces/11.jpg')}}" alt="">
                                                    </span>
                                                    <p class="text-[#8c9097] dark:text-white/50 mb-2">
                                                        <span class="text-default"><b>Json Smith</b> reacted to the post 👍</span>.<span class="ltr:float-right rtl:float-left text-[.6875rem] text-[#8c9097] dark:text-white/50">18,Dec 2022 - 12:16</span>
                                                    </p>
                                                    <p class="text-[#8c9097] dark:text-white/50 mb-0">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, repellendus rem rerum excepturi aperiam ipsam temporibus inventore ullam tempora eligendi libero sequi dignissimos cumque, et a sint tenetur consequatur omnis!
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <span class="avatar avatar-sm avatar-rounded profile-timeline-avatar">
                                                        <img src="{{asset('build/assets/images/faces/4.jpg')}}" alt="">
                                                    </span>
                                                    <p class="text-[#8c9097] dark:text-white/50 mb-2">
                                                        <span class="text-default"><b>Alicia Keys</b> shared a document with <b>you</b></span>.<span class="ltr:float-right rtl:float-left text-[.6875rem] text-[#8c9097] dark:text-white/50">21,Dec 2022 - 15:32</span>
                                                    </p>
                                                    <p class="profile-activity-media mb-0 flex w-full mt-2 sm:mt-0 items-center">
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/file-manager/3.png')}}" alt="">
                                                        </a>
                                                        <span class="text-[.6875rem] text-[#8c9097] dark:text-white/50">432.87KB</span>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <span class="avatar avatar-sm bg-success/10 !text-success avatar-rounded profile-timeline-avatar">
                                                        P
                                                    </span>
                                                    <p class="text-[#8c9097] dark:text-white/50 mb-4">
                                                        <span class="text-default"><b>You</b> shared a post with 4 people <b>Simon,Sasha, Anagha,Hishen</b></span>.<span class="ltr:float-right rtl:float-left text-[.6875rem] text-[#8c9097] dark:text-white/50">28,Dec 2022 - 18:46</span>
                                                    </p>
                                                    <p class="profile-activity-media mb-4">
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/media-75.jpg')}}" alt="">
                                                        </a>
                                                    </p>
                                                    <div>
                                                        <div class="avatar-list-stacked">
                                                            <span class="avatar avatar-sm avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/2.jpg')}}" alt="img">
                                                            </span>
                                                            <span class="avatar avatar-sm avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/8.jpg')}}" alt="img">
                                                            </span>
                                                            <span class="avatar avatar-sm avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/2.jpg')}}" alt="img">
                                                            </span>
                                                            <span class="avatar avatar-sm avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/10.jpg')}}" alt="img">
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <span class="avatar avatar-sm avatar-rounded profile-timeline-avatar">
                                                        <img src="{{asset('build/assets/images/faces/5.jpg')}}" alt="">
                                                    </span>
                                                    <p class="text-[#8c9097] dark:text-white/50 mb-1">
                                                        <span class="text-default"><b>Melissa Blue</b> liked your post <b>travel excites</b></span>.<span class="ltr:float-right rtl:float-left text-[.6875rem] text-[#8c9097] dark:text-white/50">11,Dec 2022 - 11:18</span>
                                                    </p>
                                                    <p class="text-[#8c9097] dark:text-white/50">you are already feeling the tense atmosphere of the video playing in the background</p>
                                                    <p class="profile-activity-media sm:flex mb-0">
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/media-59.jpg')}}" class="m-1" alt="">
                                                        </a>
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/media-60.jpg')}}" class="m-1" alt="">
                                                        </a>
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/media-61.jpg')}}" class="m-1" alt="">
                                                        </a>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <span class="avatar avatar-sm avatar-rounded profile-timeline-avatar">
                                                        <img src="{{asset('build/assets/images/media/media-39.jpg')}}" alt="">
                                                    </span>
                                                    <p class="mb-1">
                                                        <b>You</b> Commented on <b>Peter Engola</b> post <a class="text-secondary" href="javascript:void(0);"><u>#Mother Nature</u></a>.<span class="ltr:float-right rtl:float-left text-[.6875rem] text-[#8c9097] dark:text-white/50">24,Dec 2022 - 14:34</span>
                                                    </p>
                                                    <p class="text-[#8c9097] dark:text-white/50">Technology id developing rapidly kepp uo your work 👌</p>
                                                    <p class="profile-activity-media mb-0 flex w-full mt-2 sm:mt-0">
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/media-26.jpg')}}" alt="">
                                                        </a>
                                                        <a aria-label="anchor" href="javascript:void(0);">
                                                            <img src="{{asset('build/assets/images/media/media-29.jpg')}}" alt="">
                                                        </a>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade !p-0 !border-0 hidden !rounded-md" id="posts-tab-pane"
                                        role="tabpanel" aria-labelledby="posts-tab" tabindex="0">
                                        <ul class="list-group !rounded-md">
                                            <li class="list-group-item">
                                                <div class="sm:flex items-center leading-none">
                                                    <div class="me-4">
                                                        <span class="avatar avatar-md avatar-rounded">
                                                            <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="">
                                                        </span>
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div class="flex">
                                                            <input type="text" class="form-control !rounded-e-none !w-full" placeholder="Recipient's username" aria-label="Recipient's username with two button addons">
                                                            <button aria-label="button" class="ti-btn ti-btn-light !rounded-none !mb-0" type="button"><i class="bi bi-emoji-smile"></i></button>
                                                            <button aria-label="button" class="ti-btn ti-btn-light !rounded-none !mb-0" type="button"><i class="bi bi-paperclip"></i></button>
                                                            <button aria-label="button" class="ti-btn ti-btn-light !rounded-none !mb-0" type="button"><i class="bi bi-camera"></i></button>
                                                            <button class="ti-btn bg-primary !mb-0 !rounded-s-none text-white" type="button">Post</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item" id="profile-posts-scroll">
                                                <div class="grid grid-cols-12 gap-4">
                                                    <div class="xxl:col-span-12 xl:col-span-12 lg:col-span-12 md:col-span-12 col-span-12">
                                                        <div class="rounded border dark:border-defaultborder/10">
                                                            <div class="p-4 flex items-start flex-wrap">
                                                                <div class="me-2">
                                                                    <span class="avatar avatar-sm avatar-rounded">
                                                                        <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="">
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow">
                                                                    <p class="mb-1 font-semibold leading-none">You</p>
                                                                    <p class="text-[.6875rem] mb-2 text-[#8c9097] dark:text-white/50">24, Dec - 04:32PM</p>
                                                                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mb-4">As opposed to using 'Content here 👌</p>
                                                                    <div class="flex items-center justify-between md:mb-0 mb-2">
                                                                        <div>
                                                                            <div class="btn-list">
                                                                                <button type="button" class="ti-btn ti-btn-primary !me-[.375rem] !py-1 !px-2 !text-[0.75rem] !font-medium btn-wave">
                                                                                    Comment
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn !me-[.375rem] ti-btn-sm ti-btn-success">
                                                                                    <i class="ri-thumb-up-line"></i>
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-danger">
                                                                                    <i class="ri-share-line"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-start">
                                                                    <div>
                                                                        <span class="badge bg-primary/10 text-primary me-2">Fashion</span>
                                                                    </div>
                                                                    <div>
                                                                        <div class="hs-dropdown ti-dropdown">
                                                                            <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-light" aria-expanded="false">
                                                                                <i class="ti ti-dots-vertical"></i>
                                                                            </button>
                                                                            <ul class="hs-dropdown-menu ti-dropdown-menu hidden">
                                                                                <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Delete</a></li>
                                                                                <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Hide</a></li>
                                                                                <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Edit</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="xxl:col-span-12 xl:col-span-12 lg:col-span-12 md:col-span-12 col-span-12">
                                                        <div class="rounded border dark:border-defaultborder/10">
                                                            <div class="p-4 flex items-start flex-wrap">
                                                                <div class="me-2">
                                                                    <span class="avatar avatar-sm avatar-rounded">
                                                                        <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="">
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow">
                                                                    <p class="mb-1 font-semibold leading-none">You</p>
                                                                    <p class="text-[.6875rem] mb-2 text-[#8c9097] dark:text-white/50">26, Dec - 12:45PM</p>
                                                                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mb-1">Shared pictures with 4 of friends <span>Hiren,Sasha,Biden,Thara</span>.</p>
                                                                    <div class="flex leading-none justify-between mb-4">
                                                                        <div>
                                                                            <a aria-label="anchor" href="javascript:void(0);">
                                                                                <span class="avatar avatar-md me-1">
                                                                                    <img src="{{asset('build/assets/images/media/media-52.jpg')}}" alt="">
                                                                                </span>
                                                                            </a>
                                                                            <a aria-label="anchor" href="javascript:void(0);">
                                                                                <span class="avatar avatar-md me-1">
                                                                                    <img src="{{asset('build/assets/images/media/media-56.jpg')}}" alt="">
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex items-center justify-between md:mb-0 mb-2">
                                                                        <div>
                                                                            <div class="btn-list">
                                                                                <button type="button" class="ti-btn ti-btn-primary !me-[.375rem] !py-1 !px-2 !text-[0.75rem] !font-medium btn-wave">
                                                                                    Comment
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn !me-[.375rem] ti-btn-sm ti-btn-success">
                                                                                    <i class="ri-thumb-up-line"></i>
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-danger">
                                                                                    <i class="ri-share-line"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="flex items-start">
                                                                        <div>
                                                                            <span class="badge bg-success/10 text-secondary me-2">Nature</span>
                                                                        </div>
                                                                        <div>
                                                                            <div class="hs-dropdown ti-dropdown">
                                                                                <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-light" aria-expanded="false">
                                                                                    <i class="ti ti-dots-vertical"></i>
                                                                                </button>
                                                                                <ul class="hs-dropdown-menu ti-dropdown-menu hidden">
                                                                                    <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Delete</a></li>
                                                                                    <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Hide</a></li>
                                                                                    <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Edit</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-list-stacked block mt-4 text-end">
                                                                        <span class="avatar avatar-xs avatar-rounded">
                                                                            <img src="{{asset('build/assets/images/faces/2.jpg')}}" alt="img">
                                                                        </span>
                                                                        <span class="avatar avatar-xs avatar-rounded">
                                                                            <img src="{{asset('build/assets/images/faces/8.jpg')}}" alt="img">
                                                                        </span>
                                                                        <span class="avatar avatar-xs avatar-rounded">
                                                                            <img src="{{asset('build/assets/images/faces/2.jpg')}}" alt="img">
                                                                        </span>
                                                                        <span class="avatar avatar-xs avatar-rounded">
                                                                            <img src="{{asset('build/assets/images/faces/10.jpg')}}" alt="img">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="xxl:col-span-12 xl:col-span-12 lg:col-span-12 md:col-span-12 col-span-12">
                                                        <div class="rounded border dark:border-defaultborder/10">
                                                            <div class="p-4 flex items-start flex-wrap">
                                                                <div class="me-2">
                                                                    <span class="avatar avatar-sm avatar-rounded">
                                                                        <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="">
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow">
                                                                    <p class="mb-1 font-semibold leading-none">You</p>
                                                                    <p class="text-[.6875rem] mb-2 text-[#8c9097] dark:text-white/50">29, Dec - 09:53AM</p>
                                                                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mb-1">Sharing an article that excites me about nature more than what i thought.</p>
                                                                    <p class="mb-4 profile-post-link">
                                                                        <a href="javascript:void(0);" class="text-[0.75rem] text-primary">
                                                                            <u>https://www.discovery.com/ nature/caring-for-coral</u>
                                                                        </a>
                                                                    </p>
                                                                    <div class="flex items-center justify-between md:mb-0 mb-2">
                                                                        <div>
                                                                            <div class="btn-list">
                                                                                <button type="button" class="ti-btn ti-btn-primary !me-[.375rem] !py-1 !px-2 !text-[0.75rem] !font-medium btn-wave">
                                                                                    Comment
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn !me-[.375rem] ti-btn-sm ti-btn-success">
                                                                                    <i class="ri-thumb-up-line"></i>
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-danger">
                                                                                    <i class="ri-share-line"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-start">
                                                                    <div>
                                                                        <span class="badge bg-secondary/10 text-secondary me-2">Travel</span>
                                                                    </div>
                                                                    <div class="hs-dropdown ti-dropdown">
                                                                        <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-light" aria-expanded="false">
                                                                            <i class="ti ti-dots-vertical"></i>
                                                                        </button>
                                                                        <ul class="hs-dropdown-menu ti-dropdown-menu hidden">
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Delete</a></li>
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Hide</a></li>
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Edit</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="xxl:col-span-12 xl:col-span-12 lg:col-span-12 md:col-span-12 col-span-12">
                                                        <div class="rounded border dark:border-defaultborder/10">
                                                            <div class="p-4 flex items-start flex-wrap">
                                                                <div class="me-2">
                                                                    <span class="avatar avatar-sm avatar-rounded">
                                                                        <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="">
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow">
                                                                    <p class="mb-1 font-semibold leading-none">You</p>
                                                                    <p class="text-[.6875rem] mb-2 text-[#8c9097] dark:text-white/50">22, Dec - 11:22PM</p>
                                                                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mb-1">Shared pictures with 3 of your friends <span>Maya,Jacob,Amanda</span>.</p>
                                                                    <div class="flex leading-none justify-between mb-4">
                                                                        <div>
                                                                            <a aria-label="anchor" href="javascript:void(0);">
                                                                                <span class="avatar avatar-md me-1">
                                                                                    <img src="{{asset('build/assets/images/media/media-40.jpg')}}" alt="" class="rounded-md">
                                                                                </span>
                                                                            </a>
                                                                            <a aria-label="anchor" href="javascript:void(0);">
                                                                                <span class="avatar avatar-md me-1">
                                                                                    <img src="{{asset('build/assets/images/media/media-45.jpg')}}" alt="" class="rounded-md">
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex items-center justify-between md:mb-0 mb-2">
                                                                        <div>
                                                                            <div class="btn-list">
                                                                                <button type="button" class="ti-btn ti-btn-primary !me-[.375rem] !py-1 !px-2 !text-[0.75rem] !font-medium btn-wave">
                                                                                    Comment
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn !me-[.375rem] ti-btn-sm ti-btn-success">
                                                                                    <i class="ri-thumb-up-line"></i>
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-danger">
                                                                                    <i class="ri-share-line"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="flex items-start">
                                                                        <div>
                                                                            <span class="badge bg-success/10 text-secondary me-2">Nature</span>
                                                                        </div>
                                                                        <div class="hs-dropdown ti-dropdown">
                                                                            <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-light" aria-expanded="false">
                                                                                <i class="ti ti-dots-vertical"></i>
                                                                            </button>
                                                                            <ul class="hs-dropdown-menu ti-dropdown-menu hidden">
                                                                                <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Delete</a></li>
                                                                                <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Hide</a></li>
                                                                                <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Edit</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="avatar-list-stacked block mt-4 text-end">
                                                                        <span class="avatar avatar-xs avatar-rounded">
                                                                            <img src="{{asset('build/assets/images/faces/1.jpg')}}" alt="img">
                                                                        </span>
                                                                        <span class="avatar avatar-xs avatar-rounded">
                                                                            <img src="{{asset('build/assets/images/faces/5.jpg')}}" alt="img">
                                                                        </span>
                                                                        <span class="avatar avatar-xs avatar-rounded">
                                                                            <img src="{{asset('build/assets/images/faces/16.jpg')}}" alt="img">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="xxl:col-span-12 xl:col-span-12 lg:col-span-12 md:col-span-12 col-span-12">
                                                        <div class="rounded border dark:border-defaultborder/10">
                                                            <div class="p-4 flex items-start flex-wrap">
                                                                <div class="me-2">
                                                                    <span class="avatar avatar-sm avatar-rounded">
                                                                        <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="">
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow">
                                                                    <p class="mb-1 font-semibold leading-none">You</p>
                                                                    <p class="text-[.6875rem] mb-2 text-[#8c9097] dark:text-white/50">18, Dec - 12:28PM</p>
                                                                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mb-1">Followed this author for top class themes with best code you can get in the market.</p>
                                                                    <p class="mb-4 profile-post-link">
                                                                        <a href="javascript:void(0);" class="text-[0.75rem] text-primary">
                                                                            <u>https://themeforest.net/user/ spruko/portfolio</u>
                                                                        </a>
                                                                    </p>
                                                                    <div class="flex items-center justify-between md:mb-0 mb-2">
                                                                        <div>
                                                                            <div class="btn-list">
                                                                                <button type="button" class="ti-btn ti-btn-primary !me-[.375rem] !py-1 !px-2 !text-[0.75rem] !font-medium btn-wave">
                                                                                    Comment
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn !me-[.375rem] ti-btn-sm ti-btn-success">
                                                                                    <i class="ri-thumb-up-line"></i>
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-danger">
                                                                                    <i class="ri-share-line"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-start">
                                                                    <div>
                                                                        <span class="badge bg-secondary/10 text-secondary me-2">Travel</span>
                                                                    </div>
                                                                    <div class="hs-dropdown ti-dropdown">
                                                                        <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-light" aria-expanded="false">
                                                                            <i class="ti ti-dots-vertical"></i>
                                                                        </button>
                                                                        <ul class="hs-dropdown-menu ti-dropdown-menu hidden">
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Delete</a></li>
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Hide</a></li>
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Edit</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="xxl:col-span-12 xl:col-span-12 lg:col-span-12 md:col-span-12 col-span-12">
                                                        <div class="rounded border dark:border-defaultborder/10">
                                                            <div class="p-4 flex items-start flex-wrap">
                                                                <div class="me-2">
                                                                    <span class="avatar avatar-sm avatar-rounded">
                                                                        <img src="{{asset('build/assets/images/faces/9.jpg')}}" alt="">
                                                                    </span>
                                                                </div>
                                                                <div class="flex-grow">
                                                                    <p class="mb-1 font-semibold leading-none">You</p>
                                                                    <p class="text-[.6875rem] mb-2 text-[#8c9097] dark:text-white/50">02, Dec - 06:32AM</p>
                                                                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                                    <p class="text-[0.75rem] text-[#8c9097] dark:text-white/50 mb-4">There are many variations of passages 👏😍</p>
                                                                    <div class="flex items-center justify-between md:mb-0 mb-2">
                                                                        <div>
                                                                            <div class="btn-list">
                                                                                <button type="button" class="ti-btn ti-btn-primary !me-[.375rem] !py-1 !px-2 !text-[0.75rem] !font-medium btn-wave">
                                                                                    Comment
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn !me-[.375rem] ti-btn-sm ti-btn-success">
                                                                                    <i class="ri-thumb-up-line"></i>
                                                                                </button>
                                                                                <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-danger">
                                                                                    <i class="ri-share-line"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="flex items-start">
                                                                    <div>
                                                                        <span class="badge bg-primary/10 text-primary me-2">Fashion</span>
                                                                    </div>
                                                                    <div class="hs-dropdown ti-dropdown">
                                                                        <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-light" aria-expanded="false">
                                                                            <i class="ti ti-dots-vertical"></i>
                                                                        </button>
                                                                        <ul class="hs-dropdown-menu ti-dropdown-menu hidden">
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Delete</a></li>
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Hide</a></li>
                                                                            <li><a class="ti-dropdown-item !py-2 !px-[0.9375rem] !text-[0.8125rem] !font-medium block" href="javascript:void(0);">Edit</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="text-center">
                                                    <button type="button" class="ti-btn ti-btn-primary !font-medium">Show All</button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade !p-0 !border-0 hidden" id="followers-tab-pane"
                                        role="tabpanel" aria-labelledby="followers-tab" tabindex="0">
                                        <div class="grid grid-cols-12 sm:gap-x-6">
                                            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                                <div class="box !shadow-none border dark:border-defaultborder/10">
                                                    <div class="box-body p-6">
                                                        <div class="text-center">
                                                            <span class="avatar avatar-xl avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/2.jpg')}}" alt="">
                                                            </span>
                                                            <div class="mt-2">
                                                                <p class="mb-0 font-semibold">Samantha May</p>
                                                                <p class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">samanthamay2912@gmail.com</p>
                                                                <span class="badge bg-info/10 rounded-full text-info">Team Member</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer text-center">
                                                        <div class="btn-list">
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Block</button>
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-primary">Unfollow</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                                <div class="box !shadow-none border dark:border-defaultborder/10">
                                                    <div class="box-body p-6">
                                                        <div class="text-center">
                                                            <span class="avatar avatar-xl avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/15.jpg')}}" alt="">
                                                            </span>
                                                            <div class="mt-2">
                                                                <p class="mb-0 font-semibold">Andrew Garfield</p>
                                                                <p class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">andrewgarfield98@gmail.com</p>
                                                                <span class="badge bg-success/10 text-success rounded-full">Team Lead</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer text-center">
                                                        <div class="btn-list">
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Block</button>
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-primary">Unfollow</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                                <div class="box !shadow-none border dark:border-defaultborder/10">
                                                    <div class="box-body p-6">
                                                        <div class="text-center">
                                                            <span class="avatar avatar-xl avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/5.jpg')}}" alt="">
                                                            </span>
                                                            <div class="mt-2">
                                                                <p class="mb-0 font-semibold">Jessica Cashew</p>
                                                                <p class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">jessicacashew143@gmail.com</p>
                                                                <span class="badge bg-info/10 rounded-full text-info">Team Member</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer text-center">
                                                        <div class="btn-list">
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Block</button>
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-primary">Unfollow</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                                <div class="box !shadow-none border dark:border-defaultborder/10">
                                                    <div class="box-body !p-6">
                                                        <div class="text-center">
                                                            <span class="avatar avatar-xl avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/11.jpg')}}" alt="">
                                                            </span>
                                                            <div class="mt-2">
                                                                <p class="mb-0 font-semibold">Simon Cowan</p>
                                                                <p class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">jessicacashew143@gmail.com</p>
                                                                <span class="badge bg-warning/10 text-warning rounded-full">Team Manager</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer text-center">
                                                        <div class="btn-list">
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Block</button>
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-primary">Unfollow</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                                <div class="box !shadow-none border dark:border-defaultborder/10">
                                                    <div class="box-body p-6">
                                                        <div class="text-center">
                                                            <span class="avatar avatar-xl avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/7.jpg')}}" alt="">
                                                            </span>
                                                            <div class="mt-2">
                                                                <p class="mb-0 font-semibold">Amanda nunes</p>
                                                                <p class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">amandanunes45@gmail.com</p>
                                                                <span class="badge bg-info/10 rounded-full text-info">Team Member</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer text-center">
                                                        <div class="btn-list">
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Block</button>
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-primary">Unfollow</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-6 md:col-span-6 col-span-12">
                                                <div class="box !shadow-none border dark:border-defaultborder/10">
                                                    <div class="box-body p-6">
                                                        <div class="text-center">
                                                            <span class="avatar avatar-xl avatar-rounded">
                                                                <img src="{{asset('build/assets/images/faces/12.jpg')}}" alt="">
                                                            </span>
                                                            <div class="mt-2">
                                                                <p class="mb-0 font-semibold">Mahira Hose</p>
                                                                <p class="text-[0.75rem] opacity-[0.7] mb-1 text-[#8c9097] dark:text-white/50">mahirahose9456@gmail.com</p>
                                                                <span class="badge bg-info/10 rounded-full text-info">Team Member</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer text-center">
                                                        <div class="btn-list">
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] me-1 ti-btn-light">Block</button>
                                                            <button type="button" class="ti-btn btn-sm !py-1 !px-2 !text-[0.75rem] text-white bg-primary">Unfollow</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12">
                                                <div class="text-center !mt-4">
                                                    <button type="button" class="ti-btn ti-btn-primary !font-medium btn-wave">Show All</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade !p-0 !border-0 hidden" id="gallery-tab-pane"
                                        role="tabpanel" aria-labelledby="gallery-tab" tabindex="0">
                                        <div class="grid grid-cols-12 sm:gap-x-6 gap-y-6">
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-40.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-40.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-41.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-41.jpg')}}" alt="image" class="rounded-md w-full" >
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-42.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-42.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-43.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-43.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-44.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-44.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-45.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-45.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-46.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-46.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-60.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-60.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-26.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-26.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-32.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-32.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-30.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-30.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="xxl:col-span-3 xl:col-span-3 lg:col-span-3 md:col-span-6 col-span-12">
                                                <a href="{{asset('build/assets/images/media/media-31.jpg')}}" class="glightbox card" data-gallery="gallery1">
                                                    <img src="{{asset('build/assets/images/media/media-31.jpg')}}" alt="image" class="rounded-md w-full">
                                                </a>
                                            </div>
                                            <div class="col-span-12">
                                                <div class="text-center mt-6">
                                                    <button type="button" class="ti-btn ti-btn-primary !font-medium">Show All</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="xl:col-span-4 col-span-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="box-title">
                                Personal Info
                            </div>
                        </div>
                        <div class="box-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Name :
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">Sonya Taylor</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Email :
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">sonyataylor231@gmail.com</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Phone :
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">+(555) 555-1234</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Designation :
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">C.E.O</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Age :
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">28</span>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex flex-wrap items-center">
                                        <div class="me-2 font-semibold">
                                            Experience :
                                        </div>
                                        <span class="text-[0.75rem] text-[#8c9097] dark:text-white/50">10 Years</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="xl:col-span-4 col-span-12">
                    <div class="box">
                        <div class="box-header flex justify-between">
                            <div class="box-title">
                                Recent Posts
                            </div>
                            <div>
                                <span class="badge bg-primary/10 text-primary">Today</span>
                            </div>
                        </div>
                        <div class="box-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="javascript:void(0);">
                                        <div class="flex flex-wrap items-center">
                                            <span class="avatar avatar-md me-4 !mb-0">
                                                <img src="{{asset('build/assets/images/media/media-39.jpg')}}" class="img-fluid !rounded-md" alt="..." >
                                            </span>
                                            <div class="flex-grow">
                                                <p class="font-semibold mb-0">Animals</p>
                                                <p class="mb-0 text-[0.75rem] profile-recent-posts text-truncate text-[#8c9097] dark:text-white/50">
                                                    There are many variations of passages of Lorem Ipsum available
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javascript:void(0);">
                                        <div class="flex flex-wrap items-center">
                                            <span class="avatar avatar-md me-4 !mb-0">
                                                <img src="{{asset('build/assets/images/media/media-56.jpg')}}" class="img-fluid !rounded-md" alt="..." >
                                            </span>
                                            <div class="flex-grow">
                                                <p class="font-semibold mb-0">Travel</p>
                                                <p class="mb-0 text-[0.75rem] profile-recent-posts text-truncate text-[#8c9097] dark:text-white/50">
                                                    Latin words, combined with a handful of model sentence
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javascript:void(0);">
                                        <div class="flex flex-wrap items-center">
                                            <span class="avatar avatar-md me-4 !mb-0">
                                                <img src="{{asset('build/assets/images/media/media-54.jpg')}}" class="img-fluid !rounded-md" alt="..." >
                                            </span>
                                            <div class="flex-grow">
                                                <p class="font-semibold mb-0">Interior</p>
                                                <p class="mb-0 text-[0.75rem] profile-recent-posts text-truncate text-[#8c9097] dark:text-white/50">
                                                    Contrary to popular belief, Lorem Ipsum is not simply random
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <a href="javascript:void(0);">
                                        <div class="flex flex-wrap items-center">
                                            <span class="avatar avatar-md me-4 !mb-0">
                                                <img src="{{asset('build/assets/images/media/media-64.jpg')}}" class="img-fluid !rounded-md" alt="..." >
                                            </span>
                                            <div class="flex-grow">
                                                <p class="font-semibold mb-0">Nature</p>
                                                <p class="mb-0 text-[0.75rem] profile-recent-posts text-truncate text-[#8c9097] dark:text-white/50">
                                                    It is a long established fact that a reader will be distracted by the readable content
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="xl:col-span-4 col-span-12">
                    <div class="box">
                        <div class="box-header flex justify-between">
                            <div class="box-title">
                                Suggestions
                            </div>
                            <div>
                                <button type="button" class="ti-btn !py-1 !px-2 !text-[0.75rem] !font-medium ti-btn-success">View All</button>
                            </div>
                        </div>
                        <div class="box-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="flex items-center justify-between">
                                        <div class="font-semibold flex items-center">
                                            <span class="avatar avatar-xs me-2">
                                                <img src="{{asset('build/assets/images/faces/15.jpg')}}" alt="">
                                            </span>Alister
                                        </div>
                                        <div>
                                            <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-primary !mb-0">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex items-center justify-between">
                                        <div class="font-semibold flex items-center">
                                            <span class="avatar avatar-xs me-2">
                                                <img src="{{asset('build/assets/images/faces/4.jpg')}}" alt="">
                                            </span>Samantha Sams
                                        </div>
                                        <div>
                                            <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-primary !mb-0">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex items-center justify-between">
                                        <div class="font-semibold flex items-center">
                                            <span class="avatar avatar-xs me-2">
                                                <img src="{{asset('build/assets/images/faces/11.jpg')}}" alt="">
                                            </span>Jason Mama
                                        </div>
                                        <div>
                                            <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-primary !mb-0">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex items-center justify-between">
                                        <div class="font-semibold flex items-center">
                                            <span class="avatar avatar-xs me-2">
                                                <img src="{{asset('build/assets/images/faces/5.jpg')}}" alt="">
                                            </span>Alicia Sierra
                                        </div>
                                        <div>
                                            <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-primary !mb-0">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="flex items-center justify-between">
                                        <div class="font-semibold flex items-center">
                                            <span class="avatar avatar-xs me-2">
                                                <img src="{{asset('build/assets/images/faces/7.jpg')}}" alt="">
                                            </span>Kiara Advain
                                        </div>
                                        <div>
                                            <button aria-label="button" type="button" class="ti-btn ti-btn-sm ti-btn-primary !mb-0">
                                                <i class="ri-add-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    @section('scripts')

        <!-- Gallery JS -->
        <script src="{{asset('build/assets/libs/glightbox/js/glightbox.min.js')}}"></script>

        <!-- Internal Profile JS -->
        @vite('resources/assets/js/profile.js')

            
    @endsection
</div>
