<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleMenu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        // Hanya superadmin yang boleh akses
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }
        $roles = User::select('role')->distinct()->pluck('role');
        $menus = \App\Models\Menu::pluck('slug')->toArray();
        $roleMenus = RoleMenu::all();
        return view('settings.setting', compact('roles', 'menus', 'roleMenus'));
    }

    public function update(Request $request)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }
        $access = $request->input('access', []);
        // Loop semua role dan menu, update akses
        foreach ($access as $menu => $roles) {
            foreach ($roles as $role => $val) {
                RoleMenu::updateOrCreate([
                    'role' => $role,
                    'menu' => $menu
                ], [
                    'can_access' => 1
                ]);
            }
        }
        // Set can_access=0 untuk menu yang tidak dicentang
        $allRoles = User::select('role')->distinct()->pluck('role');
        $allMenus = \App\Models\Menu::pluck('slug')->toArray();
        foreach ($allRoles as $role) {
            foreach ($allMenus as $menu) {
                if (!isset($access[$menu]) || !isset($access[$menu][$role])) {
                    RoleMenu::updateOrCreate([
                        'role' => $role,
                        'menu' => $menu
                    ], [
                        'can_access' => 0
                    ]);
                }
            }
        }
        return redirect()->route('settings.index')->with('success', 'Permission updated!');
    }
}
