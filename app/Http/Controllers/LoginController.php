<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login',[
            'title' => 'Login',
    
        ]
    );
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|min:5|max:255',
            'password' => 'required|min:5|max:255'
        ]);
        if (Auth::attempt($credentials))
        {

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin'); // Ganti '/admin/dashboard' dengan rute admin yang sesuai
            } elseif (Auth::user()->role === 'user') {
                return redirect()->intended('/admin'); // Ganti '/dashboard' dengan rute dashboard pengguna biasa yang sesuai
            }
    
            // $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal');
        // dd('berhasil login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }
}
