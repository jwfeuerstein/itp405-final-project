<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function registerForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $loginSuccessful = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);

        if ($loginSuccessful) {
            return redirect()->route('lineups.index')->with('success', 'Successfully logged in.');
        } else {
            return redirect()->route('auth.loginForm')->with('error', 'Invalid credentials.');
        }
    }
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);
        return redirect()->route('lineups.index')->with('success', 'Successfully registered.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('lineups.index')->with('success', 'Successfully logged out.');
    }
}
