@extends('layouts.notus-section')
@section('content')
@include('layouts.navbar-notus')
<main>
    <section class="relative w-full h-full py-40 min-h-screen">
        <div class="absolute top-0 w-full h-full bg-slate-800 bg-full bg-no-repeat" style="background-image: url({{asset('img/new-bg.png')}})"></div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div class="flex flex-col items-center mb-6">
                        <img src="{{ asset('img/logos/logo-white.png') }}" alt="Logo SimpanData" class="h-16 mb-2 bg-gray-300 p-2 rounded">
                        <span class="text-2xl font-bold text-white tracking-wide mb-2">SIMPANDATA</span>
                    </div>
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-200 border-0">
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center mb-3">
                                <h6 class="text-slate-500 text-sm font-bold">Sign in</h6>
                            </div>
                        </div>
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <form id="loginForm" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
                                </div>
                                <div class="mb-4">
                                    <x-label for="password" :value="__('Password')" />
                                    <x-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                                </div>
                                <div class="text-center mt-6">
                                    <x-button class="w-full">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        {{ __('Sign In') }}
                                    </x-button>
                                </div>
                                <div class="text-center mt-6">
                                    <span class="text-slate-400 text-xs">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar disini</a></span>
                                </div>
                            </form>
                            @include('auth.otp-modal')
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
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-6">
                        <div class="w-full text-center">
                            <a href="{{ route('register') }}" class="text-slate-200"><small>Belum punya akun? Daftar</small></a>
                        </div>
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
                            <a href="https://www.creative-tim.com/product/notus-js" target="_blank" class="text-white hover:text-green-400 text-sm font-semibold py-1">Notus Tailwind JS</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
</main>
@endsection
                                    }
                                });

                                // OTP input logic
                                const otpInputs = document.querySelectorAll('.otp-input');
                                otpInputs.forEach((input, idx) => {
                                    input.addEventListener('input', function() {
                                        if (this.value.length === 1 && idx < otpInputs.length - 1) {
                                            otpInputs[idx + 1].focus();
                                        }
                                    });
                                    input.addEventListener('keydown', function(e) {
                                        if (e.key === 'Backspace' && this.value === '' && idx > 0) {
                                            otpInputs[idx - 1].focus();
                                        }
                                    });
                                });
                                // Gabungkan input sebelum submit OTP
                                const otpForm = document.getElementById('otpForm');
                                otpForm.addEventListener('submit', async function(e) {
                                    e.preventDefault();
                                    let otp = '';
                                    otpInputs.forEach(input => { otp += input.value; });
                                    document.getElementById('otp_code_joined').value = otp;
                                    const otpFormData = new FormData(otpForm);
                                    try {
                                        const response = await fetch("{{ route('otp.verify') }}", {
                                            method: 'POST',
                                            headers: {
                                                'X-Requested-With': 'XMLHttpRequest',
                                                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                                            },
                                            body: otpFormData
                                        });
                                        const data = await response.json();
                                        if (data.success) {
                                            window.location.href = data.redirect;
                                        } else {
                                            document.getElementById('otpError').classList.remove('d-none');
                                            document.getElementById('otpError').innerText = data.message || 'OTP salah atau kadaluarsa.';
                                        }
                                    } catch (err) {
                                        document.getElementById('otpError').classList.remove('d-none');
                                        document.getElementById('otpError').innerText = 'Terjadi kesalahan koneksi.';
                                    }
                                });
                                // Close modal
                                document.getElementById('closeOtpModal').addEventListener('click', function(e) {
                                    e.preventDefault();
                                    document.getElementById('otpModal').style.display = 'none';
                                });
                            });
                            </script>
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-6">
                        <div class="w-1/2">
                            <a href="#pablo" class="text-slate-200"><small>Forgot password?</small></a>
                        </div>
                        <div class="w-1/2 text-right">
                            <a href="" class="text-slate-200"><small>Create new
                                    account</small></a>
                        </div>
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
    /* Make dynamic date appear */
    (function() {
        if (document.getElementById("get-current-year")) {
            document.getElementById("get-current-year").innerHTML =
                new Date().getFullYear();
        }
    })();
    /* Function for opning navbar on mobile */
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("block");
    }
    /* Function for dropdowns */
    function openDropdown(event, dropdownID) {
        let element = event.target;
        while (element.nodeName !== "A") {
            element = element.parentNode;
        }
        Popper.createPopper(element, document.getElementById(dropdownID), {
            placement: "bottom-start"
        });
        document.getElementById(dropdownID).classList.toggle("hidden");
        document.getElementById(dropdownID).classList.toggle("block");
    }
</script>
@endsection

