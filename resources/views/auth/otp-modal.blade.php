<!-- Modal OTP Reusable untuk Login/Register/OTP Step -->
<div id="otpModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5);">
    <div style="max-width:400px; margin:10vh auto; background:#fff; border-radius:8px; box-shadow:0 2px 16px #0002; padding:2rem; position:relative;">
        <h3 class="mb-3 text-center fw-bold">Verifikasi OTP</h3>
        <p class="text-center mb-4">Kode OTP telah dikirim ke email <b id="otpEmail"></b><br>Masukkan kode OTP di bawah ini untuk melanjutkan.</p>
        <form id="otpForm" method="POST">
            @csrf
            <input type="hidden" name="email" id="otp_email_input">
            <input type="hidden" name="otp_code" id="otp_code_joined">
            <div style="display:flex; justify-content:center; gap:8px; margin-bottom:1rem;">
                <input type="text" maxlength="1" pattern="[0-9]*" inputmode="numeric" class="form-control text-center otp-input" style="width: 45px; font-size: 1.5rem; border:1.5px solid #a3a3a3; border-radius:6px;" required>
                <input type="text" maxlength="1" pattern="[0-9]*" inputmode="numeric" class="form-control text-center otp-input" style="width: 45px; font-size: 1.5rem; border:1.5px solid #a3a3a3; border-radius:6px;" required>
                <input type="text" maxlength="1" pattern="[0-9]*" inputmode="numeric" class="form-control text-center otp-input" style="width: 45px; font-size: 1.5rem; border:1.5px solid #a3a3a3; border-radius:6px;" required>
                <input type="text" maxlength="1" pattern="[0-9]*" inputmode="numeric" class="form-control text-center otp-input" style="width: 45px; font-size: 1.5rem; border:1.5px solid #a3a3a3; border-radius:6px;" required>
                <input type="text" maxlength="1" pattern="[0-9]*" inputmode="numeric" class="form-control text-center otp-input" style="width: 45px; font-size: 1.5rem; border:1.5px solid #a3a3a3; border-radius:6px;" required>
                <input type="text" maxlength="1" pattern="[0-9]*" inputmode="numeric" class="form-control text-center otp-input" style="width: 45px; font-size: 1.5rem; border:1.5px solid #a3a3a3; border-radius:6px;" required>
            </div>
            <div class="text-center mb-2" style="font-size:0.95rem;">
                <span id="resendText">Resend available: </span>
                <a href="#" id="resendOtpBtn" style="color:#d100a6; font-weight:600; text-decoration:underline;">Resend OTP</a>
            </div>
            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-lg w-full" style="background-color:#d100a6;border-color:#d100a6;color:#fff;font-weight:600;font-size:1.1rem;">Verifikasi</button>
            </div>
            <div class="d-grid mb-2">
                <button type="button" class="btn btn-secondary btn-lg w-full" id="closeOtpModal" style="background-color:#ef4444;border-color:#ef4444;color:#fff;font-weight:600;font-size:1.1rem;">Batal</button>
            </div>
            <div id="otpError" class="alert alert-danger mt-2 d-none"></div>
        </form>
    </div>
</div>