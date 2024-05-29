<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function proseslogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $input = $request->all();

        // Cek pengguna berdasarkan username
        $user = User::where('username', $request->username)->first();

        Log::info('Attempting to login', ['username' => $input['username'], 'user_found' => $user ? true : false]);

        // Cek apakah pengguna ditemukan dan kata sandi cocok
        if ($user && auth()->attempt(['username' => $input['username'], 'password' => $input['password']])) {
            Log::info('User authenticated', ['user_id' => auth()->user()->id, 'role' => auth()->user()->role]);
            session(['user_id' => $user->id, 'user_role' => $user->role]);
            return redirect()->route($user->role == 'admin' ? 'dashboard.admin' : 'dashboard.fasilitator');
            // if (auth()->user()->role == "fasilitator") {
            //     Log::info('Redirecting to fasilitator dashboard');
            //     return redirect()->route('dashboard.fasilitator');
            // } else if (auth()->user()->role == "adm") {
            //     Log::info('Redirecting to admin dashboard');
            //     return redirect()->route('dashboard.admin');
            // }
        } else {
            return back()->withErrors(['Periksa Kembali Username dan Password Anda']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        // $request->session()->regenerateToken();

        return redirect('/');
    }

    public function dashboard()
    {
        return view('admin.layouts.dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}
