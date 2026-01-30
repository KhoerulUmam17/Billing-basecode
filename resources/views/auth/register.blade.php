@extends('layouts.notus-section')
@section('content')
@include('layouts.navbar-notus')
<main>
    <section class="relative w-full h-full py-40 min-h-screen">
        <div class="absolute top-0 w-full h-full bg-slate-800 bg-full bg-no-repeat" style="background-image: url({{asset('img/new-bg.png')}})"></div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-200 border-0">
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="text-center mb-3">
                                <h6 class="text-slate-500 text-sm font-bold">Register</h6>
                            </div>
                        </div>
                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            <form id="registerForm" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <x-label for="name" :value="__('Nama Lengkap')" />
                                    <x-input id="name" type="text" name="name" required autofocus placeholder="Nama Lengkap" />
                                </div>
                                <div class="mb-4">
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" type="email" name="email" required placeholder="Email" />
                                </div>
                                <div class="mb-4">
                                    <x-label for="password" :value="__('Password')" />
                                    <x-input id="password" type="password" name="password" required placeholder="Password" />
                                </div>
                                <div class="mb-4">
                                    <x-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                                    <x-input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Konfirmasi Password" />
                                </div>
                                <div class="form-check form-check-info text-left mb-3">
                                    <input class="form-check-input" type="checkbox" name="agreement" id="agreement" required>
                                    <label class="form-check-label" for="agreement">
                                        I agree to the <a href="#" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                    </label>
                                    <div id="agreementError" class="text-danger text-xs mt-2 d-none">The agreement must be accepted.</div>
                                </div>
                                <div class="text-center mt-6">
                                    <x-button class="w-full">
                                        <i class="fas fa-sign-in-alt mr-2"></i>
                                        {{ __('Register') }}
                                    </x-button>
                                </div>
                            </form>
                            @include('auth.otp-modal')
                        </div>
                    </div>
                    <div class="flex flex-wrap mt-6">
                        <div class="w-full text-center">
                            <a href="{{ route('login') }}" class="text-slate-200"><small>Sudah punya akun? Login</small></a>
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

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Register AJAX
    const registerForm = document.getElementById('registerForm');
    const agreement = document.getElementById('agreement');
    const agreementError = document.getElementById('agreementError');
    registerForm.addEventListener('submit', async function(e) {
        if (!agreement.checked) {
            e.preventDefault();
            agreementError.classList.remove('d-none');
            agreement.focus();
            return;
        } else {
            agreementError.classList.add('d-none');
        }
        e.preventDefault();
        const formData = new FormData(registerForm);
        try {
            const response = await fetch("{{ route('register.post') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            });
            const data = await response.json();
            if (data.success) {
                // Tampilkan modal OTP
                document.getElementById('otpModal').style.display = 'block';
                document.getElementById('otpEmail').innerText = formData.get('email');
                document.getElementById('otp_email_input').value = formData.get('email');
            } else {
                alert(data.message || 'Terjadi kesalahan saat register.');
            }
        } catch (err) {
            alert('Terjadi kesalahan koneksi.');
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
@endsection

