<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Update name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update password if it is set
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the updated user information
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
