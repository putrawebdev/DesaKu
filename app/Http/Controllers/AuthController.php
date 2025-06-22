<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // $userStatus = Auth::user()->status;
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->status == 'submitted') {
                return back()->withErrors([
                    'email' => 'Your account is waiting for approval'
                ]);
            }else if (Auth::user()->status == 'rejected') {
                return back()->withErrors([
                    'email'  => 'Your account rejected'
                ]);
            }
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Terjadi kesalahan, silahkan periksa kembali email atau password anda.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function registerView()
    {
        return view('pages.auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = 2;
        $user->saveOrFail();

        return redirect('/')->with('success', 'Create Account Success, please waiting for approval');
    }
}
