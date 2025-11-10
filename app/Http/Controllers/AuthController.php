<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        event(new Registered($user)); // sends verification email automatically

        return redirect()->route('login')->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function showLogin() {
        return view('auth.login');
    }

//    public function login(Request $request) {
//        $credentials = $request->validate([
//            'email' => 'required|email',
//            'password' => 'required',
//        ]);
//
//        if (Auth::attempt($credentials)) {
//            $request->session()->regenerate();
//            return redirect()->route('dashboard');
//        }
//
//        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
//    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $key = Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            return back()->withErrors([
                'email' => "Too many login attempts. Try again in $seconds seconds."
            ])->with('lockout_seconds', $seconds);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::clear($key);

            $user = Auth::user();

            // ✅ Check if 2FA is enabled
            if ($user->is_two_factor_enabled) {
                // Send OTP using OtpController
                $otpController = new OtpController();
                $otpController->sendOtp($user);

//                // Logout the user temporarily until OTP is verified
//                Auth::logout();

                // Store user ID in session for OTP verification
                session(['otp_user_id' => $user->id]);

                return redirect()->route('otp.verify.form')
                    ->with('status', 'A one-time password has been sent to your email.');
            }

            // If 2FA not enabled, proceed to dashboard
            return redirect()->intended(
                $user->role === 'admin'
                    ? route('admin.dashboard')
                    : route('user.dashboard')
            );
        }

        RateLimiter::hit($key, 60);

        throw ValidationException::withMessages([
            'email' => ['Invalid credentials.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }

    public function showResetEmail() {
        return view('auth.sendEmail');
    }

    public function resetEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(10);
        // Here you could send a real email, but for now we simulate:
        Mail::raw("Here is your reset token: $token", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Password Reset Request');
        });

        return back()->with('success', 'Password reset email has been sent!');
    }
}
