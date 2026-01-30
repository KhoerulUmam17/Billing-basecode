<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        try {
            $attributes = $request->validate([
                'name' => ['required', 'max:50'],
                'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
                'password' => ['required', 'min:5', 'max:20'],
                'agreement' => ['accepted']
            ]);
            $attributes['password'] = bcrypt($attributes['password']);

            $user = User::create($attributes);

            // Generate OTP 6 digit
            $otp = random_int(100000, 999999);
            $otpExpires = now()->addMinutes(10);
            $user->otps()->create([
                'otp_code' => $otp,
                'expires_at' => $otpExpires,
                'type' => 'register',
                'used' => false,
            ]);

            // Kirim OTP ke email user
            Mail::to($user->email)->send(new OtpMail($otp));

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Akun berhasil dibuat. Silakan cek email untuk kode OTP.',
                    'email' => $user->email
                ]);
            } else {
                session()->flash('otp_code', $otp);
                session()->flash('success', 'Akun berhasil dibuat. Silakan masukkan kode OTP yang dikirim ke email Anda untuk verifikasi.');
                return redirect()->route('otp.verify.form', ['email' => $user->email]);
            }
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 500);
            } else {
                return back()->withErrors(['register' => $e->getMessage()]);
            }
        }
    }
}
