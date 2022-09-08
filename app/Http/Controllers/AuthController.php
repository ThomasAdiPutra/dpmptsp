<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(LoginRequest $request)
    {
        $login = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        if (!$login) {
            return redirect()->back()->with('error', 'Username atau password salah');
        }
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
