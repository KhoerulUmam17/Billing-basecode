<div>

    <div class="container">
        <div class="flex justify-center authentication authentication-basic items-center h-full text-defaultsize text-defaulttextcolor">
          <div class="grid grid-cols-12">
            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-2"></div>
            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-8 col-span-12">
                <div class="my-[2.5rem] flex justify-center">
                    <a href="{{url('index')}}" class="w-3/4">
                        <img src="{{asset('build/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo w-4/5">
                        <img src="{{asset('build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark w-4/5">
                    </a>
                </div>
                <div class="box ">
                    <div class="box-body !p-[3rem] bg-slate-700 rounded-md">
                        <p class="h5 font-semibold mb-2 text-center text-white">Forgot Password</p>
                        <form wire:submit='sendEmail'>
                            <div class="grid grid-cols-12 gap-y-4">
                                <div class="xl:col-span-12 col-span-12">
                                    <label class="form-label uppercase"><span class="text-white">Email</span></label>
                                    <input wire:model='email' type="text" class="form-control form-control-lg w-full !rounded-md" placeholder="email">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                
                                <div class="xl:col-span-12 col-span-12 grid mt-2">
                                    <button class="ti-btn ti-btn-primary !bg-primary !text-white !font-medium">
                                        <i class='bx bx-send text-[1.125rem]' wire:loading.remove wire:target='sendEmail'></i>
                                        <x-loader wire:loading wire:target="sendEmail"></x-loader>
                                        Send Forgot Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-4 sm:col-span-2"></div>
          </div>
        </div>
    </div>

</div>
