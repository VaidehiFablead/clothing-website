<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function showprofile()
    {
        $name = Session::get('name');
        $email = Session::get('email');

        return view('profile', compact('name', 'email'));
    }

    //  updateProfiledate
    public function updateProfile(Request $request)
    {
        // Get user by email stored in session
        $user = Login::where('email', Session::get('email'))->first();

        if ($user) {
            // Update fields
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            // Update session values
            Session::put('name', $user->name);
            Session::put('email', $user->email);

            return redirect('/profile')->with('status', 'Profile updated successfully');
        }

        return back()->with('error', 'User not found');
    }


    // change password
    public function showChangePasswordForm()
    {
        return view('changePassword'); // create change-password.blade.php
    }

    public function changePassword(Request $request)
    {
        // Validate form input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Get user by session email
        $user = Login::where('email', Session::get('email'))->first();

        // Check old password
        if (!$user || $user->password !== $request->old_password) {
            return back()->with('error', 'Old password is incorrect');
        }

        // Update to new password directly (plain text)
        $user->password = $request->new_password;
        $user->save();

        return redirect('/profile')->with('status', 'Password updated successfully');
    }
}
