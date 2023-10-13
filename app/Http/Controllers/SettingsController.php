<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function index()
    {
        return view('authentication.settings');
    }

    public function showPasswordForm()
    {
        return view('authentication.change');
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
        return view('authentication.reset');
    }

    public function resetPassword(Request $request)
    {
    }

    public function showSearchPage()
    {
        $matchedUsers = [];

        return view('search', compact('matchedUsers'));
    }
    public function searchUsers(Request $request)
    {
        $searchInput = $request->input('search_input');

        $matchedUsers = User::where('name', 'like', '%' . $searchInput . '%')
            ->orWhere('email', 'like', '%' . $searchInput . '%')
            ->orWhere('username', 'like', '%' . $searchInput . '%')
            ->get();

        return view('search', ['matchedUsers' => $matchedUsers]);
    }
}
