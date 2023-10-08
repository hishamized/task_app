<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function showSignupForm()
{
    return view('signup');
}

public function signup(Request $request)
{

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'username' => 'required|string|min:8|max:255|unique:users',
        'phone_country_code' => 'required|string|max:255',
        'phone_number' => 'required|string|digits:10|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);


    $user = new User();
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->username = $request->input('username');
    $user->phone_country_code = $request->input('phone_country_code');
    $user->phone_number = $request->input('phone_number');
    $user->password = Hash::make($request->input('password'));


    $user->save();


    return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
}


public function showLoginForm()
{
    return view('login');
}


public function login(Request $request)
{
    $request->validate([
        'login_credential' => 'required|string',
        'password' => 'required|string',
    ]);

    $loginType = filter_var($request->input('login_credential'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $credentials = [
        $loginType => $request->input('login_credential'),
        'password' => $request->input('password'),
    ];

    if (auth()->attempt($credentials)) {
        return redirect('/')->with('success', 'Login successful. Welcome!');
    }

    return back()->withErrors(['login' => 'Invalid credentials']);
}

public function logout(Request $request)
{
    Auth::logout();

    return redirect('/login')->with('success', 'You have been logged out.');

}




}
