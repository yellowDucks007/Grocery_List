<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;    
use App\Models\GroceryItem;

class ProfileController extends Controller
{
    /* Show the profile page */
    public function index()
    {
        $user           = Auth::user();
        $totalItems     = GroceryItem::where('user_id', $user->id)->count();
        $completedItems = GroceryItem::where('user_id', $user->id)->where('status', 'completed')->count();
        $pendingItems   = GroceryItem::where('user_id', $user->id)->where('status', 'pending')->count();

        return view('profile.index', compact('user', 'totalItems', 'completedItems', 'pendingItems'));
    }

    /* Show the edit profile page */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /* Handle profile update */
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

        /* Only update password if a new one was typed */
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        /* Handle profile picture upload */
        if ($request->hasFile('avatar')) {
            /* Delete old avatar if it exists */
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $path         = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully!');
    }
}