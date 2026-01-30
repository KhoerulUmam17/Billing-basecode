<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAccessSettingsController extends Controller
{
    public function index()
    {
        // Only allow superadmin
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }
        $roles = \App\Models\User::select('role')->distinct()->pluck('role');
        $menus = \App\Models\Menu::pluck('slug')->toArray();
        $roleMenus = \App\Models\RoleMenu::all();
        return view('role_access_settings.index', compact('roles', 'menus', 'roleMenus'));
    }
}
