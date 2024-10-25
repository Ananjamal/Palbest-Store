<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Handle profile image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Get the authenticated user
            $user = $request->user();

            // If the user already has a profile image, delete the old one
            if ($user->image) {
                // Ensure the old image file exists and delete it from the storage
                \Storage::disk('public')->delete($user->image);
            }

            // Store the new image in 'profile-images' directory in 'public'
            $imagePath = $request->file('image')->store('profile-images', 'public');

            // Save the new image path to the user's profile
            $user->image = $imagePath;
        }

        // Update other profile information
        $request->user()->fill($request->validated());

        // Reset email verification if email was changed
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Save the user information
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }




    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
