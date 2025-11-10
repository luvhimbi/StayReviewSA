<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Load user's properties with images and reviews count/average
        $properties = $user->properties()->with('images', 'reviews')->get()->map(function($property) {
            $property->averageRating = $property->reviews->avg('overall_rating') ?? 0;
            $property->reviewCount = $property->reviews->count();
            return $property;
        });

        // Load user's reviews with property info
        $reviews = $user->reviews()->with('property')->latest()->get();

        return view('profile.index', compact('user', 'properties', 'reviews'));
    }



    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }

    // New method for changing password
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if current password matches
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        // Logout user after password change
        Auth::logout();

        return redirect()->route('login')->with('success', 'Password changed successfully. Please log in again.');
    }

    public function destroy()
    {
        $user = Auth::user();

        // Optional: Soft delete if using SoftDeletes
        // $user->delete();

        // Or permanently delete
        $user->forceDelete();

        // Logout user
        Auth::logout();

        return redirect()->route('login')->with('success', 'Your account has been deactivated.');
    }

}
