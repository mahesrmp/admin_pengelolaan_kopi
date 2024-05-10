<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

        $user = User::where('username', $input['username'])->first();

        if ($user && auth()->attempt(array('username' => $input['username'], 'password' => $input['password']))) {
            auth()->login($user);

            if ($user->role == "admin") {
                return redirect('/admin/dashboard');
            } else if ($user->role == "fasilitator") {
                return redirect('/fasilitator/dashboard');
            }
        }

        return back()->with('warning', 'Login Failed!!')->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function dashboard()
    {
        return view('admin.layouts.dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}
