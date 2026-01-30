<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public bool $modeEditPhoto = false;

    public bool $modeEditContactInfo = false;

    public $photo;

    public $mobile_phone;

    public $nik;

    public function cancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->modeEditPhoto = false;
        $this->modeEditContactInfo = false;
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024|mimes:jpg,jpeg,png', // Validasi untuk hanya menerima JPG dan PNG
        ]);
    }

    public function save()
    {
        $this->validate([
            'photo' => 'image|max:1024|mimes:jpg,jpeg,png',
        ]);

        try {
            $user = auth()->user();

            // Periksa dan hapus foto profil sebelumnya jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            // Proses penyimpanan foto baru
            $path = $this->photo->store('profile-photos', 'public');

            // Simpan path baru ke database
            $user->update([
                'photo' => $path,
            ]);

            $this->modeEditPhoto = false;
            $this->dispatch('photoUpdated', $path);
            $this->alert('success', 'Photo berhasil disimpan.');
        } catch (\Exception $e) {
            $this->alert('error', 'Ada Kesalahan. '.$e->getMessage());
        }
    }

    public function saveMobile()
    {
        $this->validate([
            'mobile_phone' => 'required|min:6|max:16',
            'nik' => 'required|max:16',
        ]);

        try {
            $user = auth()->user();

            // Simpan path baru ke database
            $user->update([
                'mobile_phone' => $this->mobile_phone,
                'nik' => $this->nik,
            ]);

            $this->modeEditContactInfo = false;
            $this->reset();
            $this->resetErrorBag();
            $this->alert('success', 'Contact berhasil disimpan.');
        } catch (\Exception $e) {
            $this->alert('error', 'Ada Kesalahan. '.$e->getMessage());
        }
    }

    public function toggleModeEdit()
    {
        $this->modeEditPhoto = ! $this->modeEditPhoto;
    }

    public function toggleModeEditMobile()
    {
        $this->mobile_phone = auth()->user()->mobile_phone;
        $this->nik = auth()->user()->nik;
        $this->modeEditContactInfo = ! $this->modeEditContactInfo;
    }

    public function render()
    {
        return view('livewire.profile-component');
    }
}
