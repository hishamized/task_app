<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $userProfile = $user->profile;

        if($userProfile === null) {
            return view('profile');
        }

        return view('profile', ['userProfile' => $userProfile]);
    }

    public function createProfile(Request $request)
{

    $request->validate([
        'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
        'street_address' => 'required|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'country' => 'required|string',
        'pin_code' => 'required|string',
        'date_of_birth' => 'required|date',
        'qualification' => 'required|string',
        'designation' => 'required|string',
        'skills' => 'required|string',
        'status' => 'required|string',
        'salary' => 'required|numeric',
    ]);


    $profilePicturePath = null;
    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = Storage::disk('public')->put('profile_pictures', $request->file('profile_picture'));
    }


    $address = [
        'street_address' => $request->input('street_address'),
        'city' => $request->input('city'),
        'state' => $request->input('state'),
        'country' => $request->input('country'),
        'pin_code' => $request->input('pin_code'),
    ];


    $skills = explode(', ', $request->input('skills'));


    $user = Auth::user();
    $profile = $user->profile ?? new Profile();

    $profile->user_id = $user->id;
    $profile->profile_picture = $profilePicturePath;
    $profile->full_address = json_encode($address);
    $profile->date_of_birth = $request->input('date_of_birth');
    $profile->qualification = $request->input('qualification');
    $profile->designation = $request->input('designation');
    $profile->skills = json_encode($skills);
    $profile->status = $request->input('status');
    $profile->salary = $request->input('salary');

    $profile->save();

    return redirect()->route('my-profile')->with('success', 'Profile updated successfully');
}

public function updateProfile(Request $request)
{

    $request->validate([


        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024',
        'street_address' => 'nullable|string',
        'city' => 'nullable|string',
        'state' => 'nullable|string',
        'country' => 'nullable|string',
        'pin_code' => 'nullable|string',
        'date_of_birth' => 'nullable|date',
        'qualification' => 'nullable|string',
        'designation' => 'nullable|string',
        'skills' => 'nullable|string',
        'status' => 'nullable|string',
        'salary' => 'nullable|numeric',
    ]);


    $user = Auth::user();


    $userProfile = $user->profile;


    if ($request->has('street_address')) {
        $fullAddress = [
            'street_address' => $request->input('street_address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'pin_code' => $request->input('pin_code'),
        ];
        $userProfile->full_address = json_encode($fullAddress);
    }


    if ($request->has('date_of_birth')) {
        $userProfile->date_of_birth = $request->input('date_of_birth');
    }

    if ($request->has('qualification')) {
        $userProfile->qualification = $request->input('qualification');
    }

    if ($request->has('designation')) {
        $userProfile->designation = $request->input('designation');
    }

    if ($request->has('skills')) {

        $skills = explode(', ', $request->input('skills'));
        $userProfile->skills = json_encode($skills);
    }

    if ($request->has('status')) {
        $userProfile->status = $request->input('status');
    }

    if ($request->has('salary')) {
        $userProfile->salary = $request->input('salary');
    }


    if ($request->hasFile('profile_picture')) {

        if ($userProfile->profile_picture) {
            Storage::disk('public')->delete($userProfile->profile_picture);
        }


        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $userProfile->profile_picture = $profilePicturePath;
    }


    $userProfile->save();


    return redirect()->route('my-profile')->with('success', 'Profile updated successfully');
}


}
