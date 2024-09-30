<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Tampilkan halaman login
    public function showLogin()
    {   
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('login');
    }

    //Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            //Redirect ke halaman dashboard jika berhasil login
            return redirect()->intended('mhsDashboard');
        }

        return redirect('login')->with('error', 'Email atau passwor salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
