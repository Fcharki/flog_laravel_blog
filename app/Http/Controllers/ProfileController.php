<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */public function update(ProfileUpdateRequest $request)
{
    $user = $request->user();

    if ($request->hasFile('avatar')) {
        $request->validate([
            'avatar' => 'image|max:2048', // Validate the image and its size
        ]);

        // Store the new avatar
        $path = $request->file('avatar')->store('avatars', 'public');

         // Optimize the image
         ImageOptimizer::optimize(storage_path("app/public/{$path}"));

        // Delete the old avatar if it exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Update the user's avatar path
        $user->avatar = $path;
    }

    // Update the user's other profile information
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->occupation = $request->input('occupation'); // Update occupation
    $user->bio = $request->input('bio'); // Update bio

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return redirect()->route('profile.edit')->with('success', 'profile-updated');
}
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Delete the user's avatar if it exists
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account deleted');;
    }
}
