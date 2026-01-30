<?php

namespace App\Livewire;

use App\Jobs\TelegramJob;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class LandingComponent extends Component
{
    use LivewireAlert;

    public array $kendala = [];

    public $loading = false;

    public function render()
    {
        return view('livewire.landing-component')->layout('layouts.notus');
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

    public function store()
    {
        if (! array_key_exists('name', $this->kendala) && ! array_key_exists('message', $this->kendala)) {
            $this->alert('error', 'minimal isi nama dan pesannya');
        } else {
            try {
                $data = [];
                $data['jenis'] = 'kendala';
                $data['name'] = $this->kendala['name'];
                $data['message'] = $this->kendala['message'];
                $data['email'] = array_key_exists('email', $this->kendala) ? $this->kendala['email'] : '-';

                Artisan::call('cache:clear');
                dispatch(new TelegramJob($data));

                $this->kendala = [];
                $this->alert('success', 'kendala berhasil dikirim, terima kasih.');
            } catch (\Exception $e) {
                $this->alert('error', 'ada kesalahan admin');
            }
        }
    }
}
