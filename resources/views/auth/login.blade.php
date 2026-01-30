@extends('layouts.notus-section')
@section('content')
@include('layouts.navbar-notus')
<main>
    <section class="relative w-full h-full py-40 min-h-screen">
        <div class="absolute top-0 w-full h-full bg-slate-800 bg-full bg-no-repeat" style="background-image: url({{asset('img/new-bg.png')}})"></div>
        <div class="container mx-auto px-4 h-full flex items-center justify-center">
            <div class="w-full max-w-md mx-auto">
                <div class="flex flex-col items-center mb-6">
                    <img src="{{ asset('img/logos/logo-white.png') }}" alt="Logo SimpanData" class="h-16 mb-2 bg-gray-300 p-2 rounded">
                    <span class="text-2xl font-bold text-white tracking-wide mb-2 text-center">SIMPANDATA</span>
                </div>
                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-200 border-0">
                    <div class="rounded-t mb-0 px-6 py-6">
                        <div class="text-center mb-3">
                            <h6 class="text-slate-500 text-xl font-bold text-center">Sign in</h6>
                        </div>
                    </div>
                    <div class="flex-auto px-6 py-8 pt-0">
                        <form id="loginForm" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <x-label for="email" :value="__('Email')" class="text-base" />
                                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" class="w-full" />
                            </div>
                            <div>
                                <x-label for="password" :value="__('Password')" class="text-base" />
                                <x-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password" class="w-full" />
                            </div>
                            <div class="mt-6">
                                <x-button class="w-full text-base font-bold py-3 text-center">
                                    <span class="flex items-center justify-center w-full">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        {{ __('Sign In') }}
                                    </span>
                                </x-button>
                            </div>
                            <div class="mt-6 text-center">
                                <span class="text-slate-400 text-xs">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar disini</a></span>
                            </div>
                        </form>
                        @include('auth.otp-modal')
                    </div>
                </div>
            </div>
        </div>
        <footer class="absolute w-full bottom-0 bg-slate-800 pb-6">
            <div class="container mx-auto px-4">
                <hr class="mb-6 border-b-1 border-slate-600" />
                <div class="flex flex-wrap items-center">
                    <div class="w-full px-4 flex justify-center">
                        <div class="text-sm text-white font-semibold py-1 text-center md:text-left">
                            Copyright © <span id="get-current-year"></span> cloudku | Design UI By
                            <a href="https://www.creative-tim.com/product/notus-js" target="_blank"
                                class="text-white hover:text-green-400 text-sm font-semibold py-1">
                                Notus Tailwind JS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
</main>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Login AJAX
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(loginForm);
        try {
            const response = await fetch("{{ route('login') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            });
            const data = await response.json();
            if (data.success && data.otp_required) {
                // Tampilkan modal OTP
                document.getElementById('otpModal').style.display = 'block';
                document.getElementById('otpEmail').innerText = formData.get('email');
                document.getElementById('otp_email_input').value = formData.get('email');
            } else if (data.success && data.redirect) {
                window.location.href = data.redirect;
            } else {
                alert(data.message || 'Login gagal.');
            }
        } catch (err) {
            alert('Terjadi kesalahan koneksi.');
        }
    });
});
</script>
@endsection

