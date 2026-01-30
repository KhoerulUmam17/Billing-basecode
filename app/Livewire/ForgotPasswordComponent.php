<?php

namespace App\Livewire;

use App\Jobs\SendForgotPasswordJob;
use Illuminate\Support\Facades\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ForgotPasswordComponent extends Component
{
    use LivewireAlert;

    public $email;

    public function render()
    {
        return view('livewire.forgot-password-component')->layout('layouts.custom-master');
    }

    public function sendEmail()
    {
        $rules = [
            'email' => 'required|email',
        ];

        $message = [
            'email.required' => 'Email Wajib diisi.',
            'email.email' => 'Format harus email.',
        ];

        $this->validate($rules, $message);

        try {
            $reset = Password::sendResetLink(['email' => $this->email]);

            dispatch(new SendForgotPasswordJob($this->email));
            $this->resetErrorBag();
            $this->reset();
            $this->alert('success', 'Email Reset Password Berhasil dikirim');
        } catch (\Exception $e) {
            $this->alert('error', 'Ada kesalahan, Hubungi Admin');
        }
    }
}
