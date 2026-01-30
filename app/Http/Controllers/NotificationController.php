<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    // Endpoint JSON untuk dropdown
    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        return response()->json($notifications);
    }

    // Halaman dashboard semua notifikasi
    public function dashboard()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notif = Notification::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $notif->is_read = true;
        $notif->save();
        return response()->json(['success' => true]);
    }
}
