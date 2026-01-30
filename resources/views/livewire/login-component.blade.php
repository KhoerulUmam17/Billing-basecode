<div class="container">
    <div class="flex justify-center authentication authentication-basic items-center h-full text-defaultsize text-defaulttextcolor">
      <div class="grid grid-cols-12 w-full">
        <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-3 sm:col-span-3"></div>
        <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-6 sm:col-span-6 col-span-12">
            <div class="my-[2.5rem] flex justify-center">
                <a href="{{url('index')}}" class="flex justify-center">
                    <img src="{{asset('build/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo w-4/5">
                    <img src="{{asset('build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark w-4/5">
                </a>
            </div>
            <div class="box ">
                <div class="box-body !p-[3rem] bg-slate-700 rounded-md">
                    <p class="h5 font-semibold mb-2 text-center text-white">Sign In</p>
                    <form wire:submit='login_store'>
                        <div class="grid grid-cols-12 gap-y-4">
                            <div class="xl:col-span-12 col-span-12">
                                <label for="signin-username" class="form-label uppercase"><span class="text-white">Username or Email</span></label>
                                <input wire:model='usernameOrEmail' type="text" class="form-control form-control-lg w-full !rounded-md" id="signin-username" placeholder="username or email">
                                @error('usernameOrEmail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="xl:col-span-12 col-span-12 mb-2">
                                <label for="signin-password" class="form-label block text-white"><span class="text-white uppercase">Password</span></label>
                                <div class="input-group">
                                    <input wire:model='password' type="password" class="form-control form-control-lg !rounded-s-md" id="signin-password" placeholder="password">
                                    <button aria-label="button" class="ti-btn ti-btn-light !rounded-s-none !mb-0" type="button" onclick="createpassword('signin-password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="xl:col-span-12 col-span-12 grid mt-2">
                                <button class="ti-btn ti-btn-primary !bg-primary !text-white !font-medium">
                                    <i class='bx bx-log-in text-[1.125rem]' wire:loading.remove wire:target='login_store'></i>
                                    <x-loader wire:loading wire:target="login_store"></x-loader>
                                    Sign In
                                </button>
                                <a href="/" class="ti-btn ti-btn-secondary-full my-3 !text-white !font-medium">
                                    <i class='bx bx-arrow-back text-[1.125rem]'></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-3 sm:col-span-3"></div>
      </div>
    </div>
</div>
<script src="{{asset('build/assets/show-password.js')}}"></script>
