<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\GroceryItem;
use App\Models\User;

class ProfileController extends Controller
{
    /* Show the edit profile page with stats */
    public function edit()
    {
        $user           = Auth::user();
        $totalItems     = GroceryItem::where('user_id', $user->id)->count();
        $completedItems = GroceryItem::where('user_id', $user->id)->where('status', 'completed')->count();
        $pendingItems   = GroceryItem::where('user_id', $user->id)->where('status', 'pending')->count();

        return view('profile.edit', compact('user', 'totalItems', 'completedItems', 'pendingItems'));
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

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->remove_avatar == 1) {

            if ($user->avatar &&
                Storage::disk('public')->exists($user->avatar)) {

                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = null;
        }

        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($user->avatar);
            $path         = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}