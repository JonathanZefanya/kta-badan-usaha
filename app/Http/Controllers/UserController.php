<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
        ];
        if ($user->role !== 'PJ') {
            $rules['role'] = 'required|in:admin,staff,PJ';
        }
        $request->validate($rules);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        if ($user->role !== 'PJ' && $request->has('role')) {
            $user->role = $request->role;
        }
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('user.settings')->with('success', 'Data berhasil diupdate');
    }

    // Tambahan agar route closure bisa panggil
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'role' => 'required|in:admin,staff,PJ',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan');
    }
    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }
    public function settingsWebsite()
    {
        return view('settings.website');
    }
    public function updateSettingsWebsite(Request $request)
    {
        return redirect()->route('admin.settings.website')->with('success', 'Settings website berhasil diupdate');
    }
}
