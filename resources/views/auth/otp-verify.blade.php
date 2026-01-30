@extends('layouts.user_type.guest')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card shadow border-0">
            <div class="card-body p-5">
                <h3 class="mb-3 text-center fw-bold">Verify OTP</h3>
                <p class="text-center mb-4">We sent an OTP to <b>{{ $email }}</b><br>Enter it below to continue.</p>
                @if(session('success'))
                    <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('otp.verify') }}" autocomplete="off" class="mb-3">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="otp_code" id="otp_code_joined">
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @for($i=0; $i<6; $i++)
                        <input type="text" maxlength="1" pattern="[0-9]*" inputmode="numeric" class="form-control text-center otp-input" style="width: 45px; font-size: 1.5rem;" required>
                        @endfor
                    </div>
                    <div class="text-center mb-3">
                        <span>Resend available: <a href="#" id="resend-otp-link">Resend OTP</a></span>
                    </div>
                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-primary btn-lg">Verify</button>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-secondary">&larr; Back to Log In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.otp-input');
    inputs.forEach((input, idx) => {
        input.addEventListener('input', function() {
            if (this.value.length === 1 && idx < inputs.length - 1) {
                inputs[idx + 1].focus();
            }
        });
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && this.value === '' && idx > 0) {
                inputs[idx - 1].focus();
            }
        });
    });

    // Gabungkan input sebelum submit
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        let otp = '';
        inputs.forEach(input => {
            otp += input.value;
        });
        document.getElementById('otp_code_joined').value = otp;
    });
});
</script>
@endsection
