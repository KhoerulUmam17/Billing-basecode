<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {
        $query = User::query();
        if (request('role')) {
            $query->where('role', request('role'));
        }
        if (request('status')) {
            $query->where('status', request('status'));
        }
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%") ;
            });
        }
        $users = $query->get();
        return view('laravel-examples.user-management', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200', // 50MB
            'phone' => 'nullable',
            'address' => 'nullable',
            'status' => 'nullable',
            'role' => 'required',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = 'user_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/user_photos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            try {
                $image->move($destinationPath, $filename);
                $photoPath = '/storage/user_photos/' . $filename;
            } catch (\Exception $e) {
                return back()->withErrors(['photo' => 'Gagal mengupload foto.']);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'photo' => $photoPath,
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status ?? 'active',
        ]);
        $user->touch();
        return redirect()->route('user-management')->with('success', 'User created successfully!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200', // 50MB
            'phone' => 'nullable',
            'address' => 'nullable',
            'status' => 'nullable',
            'role' => 'required',
        ]);
        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path(parse_url($user->photo, PHP_URL_PATH)))) {
                @unlink(public_path(parse_url($user->photo, PHP_URL_PATH)));
            }
            $image = $request->file('photo');
            $filename = 'user_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('storage/user_photos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $filename);
            $user->photo = '/storage/user_photos/' . $filename;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status ?? $user->status;
        $user->save();
        return redirect()->route('user-management')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus file foto jika ada
        if ($user->photo) {
            $photoPath = public_path($user->photo);
            if (file_exists($photoPath)) {
                @unlink($photoPath);
            }
        }

        $user->delete();
        return redirect()->route('user-management')->with('success', 'User deleted successfully!');
    }
}