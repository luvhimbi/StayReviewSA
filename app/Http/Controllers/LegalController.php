<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LegalController extends Controller
{

    public function index()
    {
        return view('legal.index');
    }
    // Show the POPI consent page
    public function popi()
    {
        return view('legal.popi');
    }

    // Handle consent submission
    public function acceptPopi(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return redirect()->route('login')->with('error', 'You must be logged in to give consent.');
            }

            if ($user->popi_consent) {
                return redirect()->route('user.dashboard')->with('info', 'You have already provided consent.');
            }

            // Mark the user as having given consent
            $user->update([
                'popi_consent' => Carbon::now()  // sets current timestamp
            ]);

            return redirect()->route('user.dashboard')->with('success', 'Thank you for providing POPI consent.');
        } catch (\Exception $e) {
            // Log the error and show friendly message
            \Log::error('POPI consent error: '.$e->getMessage());

            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
}
