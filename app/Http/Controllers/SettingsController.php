<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'notifications' => 'nullable|boolean',
        ]);

        $user->update($validated);

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully.');
    }
     public function toggle2FA(Request $request)
    {
        $user = Auth::user();

        $user->is_two_factor_enabled = !$user->is_two_factor_enabled;
        $user->save();

        return back()->with('success', $user->is_two_factor_enabled
            ? 'Two-Factor Authentication has been enabled.'
            : 'Two-Factor Authentication has been disabled.');
    }
}
