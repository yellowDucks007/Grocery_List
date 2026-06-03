<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\GroceryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show profile page
     */
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();

        $totalItems = GroceryItem::where('user_id', $user->id)->count();

        $completedItems = GroceryItem::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $pendingItems = GroceryItem::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        return view('profile.edit', compact(
            'user',
            'totalItems',
            'completedItems',
            'pendingItems'
        ));
    }

    /**
     * Update profile
     */
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

        /* Update basic information */
        $user->name = $request->name;
        $user->email = $request->email;

        /* Update password if provided */
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        /* Remove avatar */
        if ($request->remove_avatar == 1) {

            if (
                !empty($user->avatar) &&
                Storage::disk('public')->exists($user->avatar)
            ) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = null;
        }

        /* Upload new avatar */
        if ($request->hasFile('avatar')) {

            if (
                !empty($user->avatar) &&
                Storage::disk('public')->exists($user->avatar)
            ) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $request
                ->file('avatar')
                ->store('avatars', 'public');
        }

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully!');
    }
}