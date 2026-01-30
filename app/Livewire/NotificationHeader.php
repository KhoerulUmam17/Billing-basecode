<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class NotificationHeader extends Component
{
    use LivewireAlert;

    protected $listeners = ['startPolling' => 'startPolling'];

    public bool $poll = false;

    public function startPolling()
    {
        $this->poll = true;
        $this->render();
    }

    public function getNotifications()
    {
        $userId = auth()->user()->id;

        if ($this->poll) {
            Cache::put('user-notifications:'.$userId, auth()->user()->notifications()->whereNull('read_at')->get(), 60);
            $notifications = Cache::get('user-notifications:'.$userId);
        } else {
            // Coba ambil notifikasi dari cache
            $notifications = Cache::remember('user-notifications:'.$userId, 60, function () {
                // Jika tidak ada di cache, ambil dari database dan simpan ke cache
                return auth()->user()->notifications()->whereNull('read_at')->get();
            });
        }

        return $notifications;
    }

    public function render()
    {
        return view('livewire.notification-header', [
            'notification' => $this->getNotifications(),
            'poll' => Cache::get('polling:notif', false),
        ]);
    }

    public function markRead($id)
    {
        try {
            $user = auth()->user();
            $notification = $user->unreadNotifications->where('id', $id)->first();

            if ($notification) {
                $notification->markAsRead();
            }
            $this->alert('success', 'Notifikasi Berhasil Dibaca');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }

    public function markReadAll()
    {
        try {
            $user = auth()->user();
            $notification = $user->unreadNotifications->markAsRead();

            $this->alert('success', 'Semua Notifikasi berhasil di baca');
        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage());
        }
    }
}
