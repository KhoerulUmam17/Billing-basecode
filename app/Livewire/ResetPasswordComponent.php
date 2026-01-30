<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ResetPasswordComponent extends Component
{
    use LivewireAlert;

    public $token;

    public $email;

    public $password;

    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
        $this->email = request('email');

    }

    public function resetPassword()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new \Illuminate\Auth\Events\PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            $this->flash('success', 'Password berhasil Diubah', ['timer' => 3000], '/'.config('app.url_login'));
        } else {
            session()->flash('error', __($status));
        }
    }

    public function render()
    {
        return view('livewire.reset-password-component')->layout('layouts.custom-master');
    }
}
