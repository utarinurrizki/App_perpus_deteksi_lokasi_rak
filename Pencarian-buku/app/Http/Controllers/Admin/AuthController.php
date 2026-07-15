<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (!$request->filled('email') && !$request->filled('password')) {
            return back()
                ->withErrors([
                    'login' => 'Username dan password harus diisi.',
                ])
                ->withInput();
        }

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Username harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()
            ->withErrors([
                'login' => 'Username atau password yang Anda masukkan salah.',
            ])
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
