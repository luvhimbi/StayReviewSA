@extends('layouts.app')

@section('title', 'Verify OTP')

@section('content')
    <div class="max-w-md mx-auto mt-12 bg-white shadow-lg p-8 rounded-lg text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Verify One-Time Password</h1>
        <p class="text-gray-600 mb-6">Enter the 6-digit code sent to your email.</p>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf
            <input
                type="text"
                name="otp"
                maxlength="6"
                class="border border-gray-300 rounded-lg w-full px-4 py-2 mb-4 text-center focus:ring-2 focus:ring-blue-400"
                placeholder="Enter OTP"
                required
            >

            <button
                type="submit"
                class="bg-blue-600 text-white w-full py-2 rounded-lg hover:bg-blue-700 transition">
                Verify OTP
            </button>
        </form>

        <div class="mt-6">
            <p class="text-gray-600 text-sm mb-2">Didn't receive the email?</p>

            <!-- Countdown message -->
            <p id="countdown" class="text-gray-500 text-sm mb-2">
                Please wait <span id="seconds">6</span> seconds...
            </p>

            <!-- Hidden resend form -->
            <form id="resendForm" method="POST" action="{{ route('otp.resend') }}" style="display: none;">
                @csrf
                <button
                    type="submit"
                    class="text-blue-600 hover:text-blue-800 font-medium transition">
                    Resend OTP
                </button>
            </form>
        </div>
    </div>

    <!-- Countdown Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let countdown = 16;
            const secondsSpan = document.getElementById('seconds');
            const countdownText = document.getElementById('countdown');
            const resendForm = document.getElementById('resendForm');

            const timer = setInterval(() => {
                countdown--;
                secondsSpan.textContent = countdown;

                if (countdown <= 0) {
                    clearInterval(timer);
                    countdownText.style.display = 'none';
                    resendForm.style.display = 'block';
                }
            }, 1000);
        });
    </script>
@endsection
