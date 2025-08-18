<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SettingsWebsite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // List all users (admin only)
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show create user form
    public function create()
    {
        return view('users.create');
    }

    // Store new user
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

    // Show edit user form (admin)
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update user (admin)
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'role' => 'required|in:admin,staff,PJ',
        ];
        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }
        $request->validate($rules);
        $updateData = $request->only(['name','email','username','role']);
        if ($request->filled('password')) {
            $updateData['password'] = bcrypt($request->password);
        }
        $user->update($updateData);
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate');
    }

    // Login As (admin only)
    public function loginAs($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        $user = User::findOrFail($id);
        Auth::login($user);
        return redirect('/dashboard');
    }

    // Delete user (admin)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus');
    }

    // Settings user PJ
    public function editSettings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }
    public function updateSettings(Request $request)
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
    // Tampilkan form settings website
    public function showSettingsWebsite()
    {
        $settings = SettingsWebsite::first();
        $defaultName = config('app.name');
        if (!$settings || empty($settings->nama_website)) {
            $settings = $settings ?: new SettingsWebsite();
            $settings->nama_website = $defaultName;
        }
        return view('settings.website', compact('settings'));
    }

    // Simpan/update settings website
    public function updateSettingsWebsite(Request $request)
    {
        $request->validate([
            'nama_website' => 'nullable',
            'signature' => 'nullable', // base64 image
            'rekening_nama' => 'nullable',
            'rekening_bank' => 'nullable',
            'rekening_nomor' => 'nullable',
        ]);
        $settings = SettingsWebsite::first();
        if (!$settings) {
            $settings = new SettingsWebsite();
        }
        $settings->nama_website = $request->filled('nama_website') ? $request->nama_website : config('app.name');
        $settings->signature = $request->signature;
        $settings->rekening_nama = $request->rekening_nama;
        $settings->rekening_bank = $request->rekening_bank;
        $settings->rekening_nomor = $request->rekening_nomor;
        $settings->save();
        return redirect()->route('admin.settings.website')->with('success', 'Settings website berhasil diupdate');
    }

    // Settings akun admin/staff
    public function settings()
    {
        $user = Auth::user();
        return view('user.settings', compact('user'));
    }
}
