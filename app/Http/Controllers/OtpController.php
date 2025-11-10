<?php
namespace App\Http\Controllers;

use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OtpController extends Controller
{
 public function sendOtp($user)
 {
  $otp = rand(100000, 999999);

  $user->otp_code = $otp;
  $user->otp_expires_at = Carbon::now()->addMinutes(5);
  $user->save();

     Mail::to($user->email)->send(new OtpMail($otp));
}

public function showVerifyForm()
{
return view('auth.verify-otp');
}

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        // Get user from session (after login but before OTP verification)
        $userId = session('otp_user_id');
        $user = \App\Models\User::find($userId);

        if (!$user) {
            return redirect()->route('login')->withErrors(['otp' => 'Session expired. Please login again.']);
        }

        // Check OTP and expiry
        if ($user->otp_code == $request->otp && $user->otp_expires_at->isFuture()) {
            // OTP is valid
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            // Log user in
            Auth::login($user);

            session()->forget('otp_user_id');
            session(['2fa_verified' => true]);

            // Redirect based on role
            return redirect()->intended(
                $user->role === 'admin'
                    ? route('admin.dashboard')
                    : route('user.dashboard')
            );
        }

        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }


    public function resendOtp(Request $request)
    {
        $userId = session('otp_user_id');
        $user = \App\Models\User::find($userId);

        if (!$user) {
            return redirect()->route('login')->withErrors(['otp' => 'Session expired. Please login again.']);
        }

        $this->sendOtp($user);

        return back()->with('status', 'A new OTP has been sent to your email.');
    }
}
