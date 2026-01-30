@extends('layouts.user_type.guest')

@section('content')
<style>
    .otp-input {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin: 0 5px;
    }
    .otp-input:focus {
        border-color: #5e72e4;
        box-shadow: 0 0 0 0.2rem rgba(94, 114, 228, 0.25);
        outline: none;
    }
</style>
<div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="text-center mb-3">Verify OTP</h3>
                <p class="text-center text-muted mb-4">
                    We sent an OTP to <strong>{{ $email }}</strong><br>
                    Enter it below to continue.
                </p>
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                <form method="POST" action="{{ route('otp.login.verify') }}" id="otpLoginForm">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="otp_code" id="otp_code_login">
                    <div class="d-flex justify-content-center mb-3">
                        <input type="text" class="otp-input" maxlength="1" id="otp1" data-index="0" />
                        <input type="text" class="otp-input" maxlength="1" id="otp2" data-index="1" />
                        <input type="text" class="otp-input" maxlength="1" id="otp3" data-index="2" />
                        <input type="text" class="otp-input" maxlength="1" id="otp4" data-index="3" />
                        <input type="text" class="otp-input" maxlength="1" id="otp5" data-index="4" />
                        <input type="text" class="otp-input" maxlength="1" id="otp6" data-index="5" />
                    </div>
                    <p class="text-center mb-3">
                        <small class="text-muted">Resend available: </small>
                        <a href="{{ route('login') }}" class="text-primary">Resend OTP</a>
                    </p>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">Verify</button>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-muted">← Back to Log in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.otp-input');
        const form = document.getElementById('otpLoginForm');
        const hiddenOtp = document.getElementById('otp_code_login');
        
        inputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                if (this.value.length === 1) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                }
                updateHiddenOtp();
            });
            
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' && this.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
            
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text').slice(0, 6);
                pasteData.split('').forEach((char, i) => {
                    if (inputs[i]) {
                        inputs[i].value = char;
                    }
                });
                updateHiddenOtp();
                if (pasteData.length === 6) {
                    inputs[5].focus();
                }
            });
        });
        
        function updateHiddenOtp() {
            hiddenOtp.value = Array.from(inputs).map(input => input.value).join('');
        }
        
        inputs[0].focus();
    });
</script>
@endsection
