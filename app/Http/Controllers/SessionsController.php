<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        if (Auth::attempt($attributes)) {
            $user = Auth::user();
            // Generate OTP baru untuk login
            $otp = random_int(100000, 999999);
            $otpExpires = now()->addMinutes(10);
            // Simpan ke tabel otps
            $user->otps()->create([
                'otp_code' => $otp,
                'expires_at' => $otpExpires,
                'type' => 'login',
                'used' => false,
            ]);
            // Kirim OTP ke email user
            Mail::to($user->email)->send(new OtpMail($otp));
            session()->flash('otp_code', $otp);
            // AJAX/JSON response for modal OTP
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'otp_required' => true,
                    'email' => $user->email
                ]);
            }
            // Jangan logout, biarkan user tetap login sampai OTP diverifikasi
            return redirect()->route('otp.login.form', ['email' => $user->email]);
        } else {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah.'
                ], 401);
            }
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login')->with(['success'=>'You\'ve been logged out.']);
    }
}
