<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function showPasswordForm()
    {
        return view('passwords.change');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('settings')->with('success', 'Password changed successfully.');
        } else {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
    }

    public function showPasswordResetForm()
    {
        return view('passwords.reset');
    }

    public function resetPassword(Request $request)
    {
        // Logic for resetting the password goes here
    }
}

