<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /* Show the profile page */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    /* Update profile information */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        /* Handle profile picture upload */
        if ($request->hasFile('avatar')) {
            /* Delete old avatar if it exists */
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path        = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        if ($user) {
            $user->save();
        }

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}