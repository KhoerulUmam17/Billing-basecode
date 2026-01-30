<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LoginComponent extends Component
{
    use LivewireAlert;

    public $loading = false;

    public $usernameOrEmail = '';

    public $password = '';

    public $recaptcha = '';

    public function setRecaptcha($value)
    {
        $this->recaptcha = $value;
    }

    public function login()
    {
        $this->loading = true;

        return redirect(route(config('app.url_login')));
    }

    public function dashboard()
    {
        $this->loading = true;

        return redirect(route('dashboard'));
    }

    public function login_store()
    {
        $rules = [
            'usernameOrEmail' => 'required',
            'password' => 'required',
        ];

        // Cek kondisi untuk menambahkan validasi captcha
        if (config('app.use_captcha')) {
            $rules['recaptcha'] = 'required|captcha';
        }

        $messages = [
            'usernameOrEmail.required' => 'Username Atau Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'recaptcha.required' => 'Captcha Wajib Diisi',
            'recaptcha.captcha' => 'Captcha Error',
        ];

        $this->validate($rules, $messages);

        // Cek apakah input merupakan email atau username
        $fieldType = filter_var($this->usernameOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($fieldType, $this->usernameOrEmail)->first();

        if ($user) {
            if ($user->login_blocked_at == null || Carbon::parse($user->login_blocked_at)->lt(now())) {
                if (Auth::attempt([$fieldType => $this->usernameOrEmail, 'password' => $this->password])) {
                    if (! session()->has('logged_in')) {
                        activity('login')->causedBy(Auth::user())->log('User Logged In');
                        session()->put('logged_in', true); // Tandai bahwa log login sudah dicatat
                    }

                    // Reset failed_login_attempts jika login sukses
                    $user->failed_login_attempts = 0;
                    $user->login_blocked_at = null;
                    $user->save();

                    return redirect()->intended('dashboard');
                } else {
                    // Increment failed_login_attempts
                    \Log::alert('sebelum '.$user->failed_login_attempts);
                    $user->failed_login_attempts += 1;
                    \Log::alert('sesudah '.$user->failed_login_attempts);

                    if ($user->failed_login_attempts >= 5) {
                        // Set login_blocked_at jika percobaan login gagal >= 3
                        $user->login_blocked_at = now()->addMinutes(30); // Misal blokir selama 30 menit
                    }

                    $user->save();

                    $this->alert('error', 'wrong password', [
                        'color' => '#000',
                        'timer' => '5000',
                        'timerProgressBar' => true,
                    ]);
                }
            } else {
                $this->alert('error', "You can't login, wait 30 minutes then", [
                    'color' => '#000',
                    'timer' => '5000',
                    'timerProgressBar' => true,
                ]);
            }
        } else {
            $this->alert('error', 'Username or email wrong', [
                'color' => '#000',
                'timer' => '5000',
                'timerProgressBar' => true,
            ]);
        }
    }

    public function back()
    {
        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        session()->forget('logged_in');

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.login-component')->layout('layouts.custom-master');
    }

    public function reloadCaptcha()
    {
        $this->dispatch('refreshCaptcha');
    }
}
