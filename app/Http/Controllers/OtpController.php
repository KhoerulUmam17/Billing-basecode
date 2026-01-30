<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpController extends Controller
{
    public function showForm(Request $request)
    {
        $email = $request->query('email');
        return view('auth.otp-verify', compact('email'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required',
        ]);
        $otpInput = $request->otp_code;
        if (is_array($otpInput)) {
            $otpInput = implode('', $otpInput);
        }
        if (!preg_match('/^\d{6}$/', $otpInput)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Kode OTP harus 6 digit.'], 422);
            }
            return back()->withErrors(['otp_code' => 'Kode OTP harus 6 digit.']);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Email tidak ditemukan.'], 404);
            }
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }
        $otp = $user->otps()
            ->where('otp_code', $otpInput)
            ->where('used', false)
            ->where('expires_at', '>=', now())
            ->latest('id')
            ->first();
        if (!$otp) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Kode OTP salah atau sudah kadaluarsa.'], 422);
            }
            return back()->withErrors(['otp_code' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }
        $otp->used = true;
        $otp->save();
        $user->email_verified_at = now();
        $user->save();
        Auth::login($user);
        session()->regenerate();
        $redirect = route('dashboard');
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'redirect' => $redirect]);
        }
        return redirect()->route('dashboard')->with('success', 'Selamat datang di Dashboard!');
    }

    public function showOtpLoginForm(Request $request)
    {
        $email = $request->query('email');
        return view('auth.otp-login', compact('email'));
    }

    public function verifyOtpLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp_code' => 'required|digits:6',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }
        $otp = $user->otps()
            ->where('otp_code', $request->otp_code)
            ->where('used', false)
            ->where('expires_at', '>=', now())
            ->latest('id')
            ->first();
        if (!$otp) {
            return back()->withErrors(['otp_code' => 'Kode OTP salah atau sudah kadaluarsa.']);
        }
        // Tandai OTP sudah digunakan
        $otp->used = true;
        $otp->save();
        Auth::login($user);
        session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Selamat datang di Dashboard!');
    }
}