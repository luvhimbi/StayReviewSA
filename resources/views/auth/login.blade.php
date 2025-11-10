@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-100 p-6">
        <div class="bg-white  w-full max-w-lg overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Welcome Back</h2>
                    <p class="text-gray-500">Login to continue your journey</p>
                </div>
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-center font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center font-medium">
                        {{ session('error') }}
                    </div>
                @endif


                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                               class="w-full px-4 py-2 border border-gray-300  focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="password" name="password" placeholder="********"
                               class="w-full px-4 py-2 border border-gray-300  focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                    </div>

                    <button type="submit"
                            class="w-full mt-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 transition transform hover:scale-[1.02] shadow-md">
                        Login
                    </button>

                    <div class="text-center mt-5">
                        <a href="{{ route('reset.email') }}" class="text-indigo-600 font-medium hover:underline">Forgot your password?</a>
                    </div>

                    <div class="text-center mt-5">
                        <p class="text-gray-600">Don’t have an account?
                            <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Register</a>
                        </p>
                    </div>
                </form>
                @if(session('lockout_seconds'))
                    <p id="countdown" class="mt-4 text-red-600 font-medium text-center">Please wait {{ session('lockout_seconds') }} seconds before trying again.</p>
                @endif
            </div>
        </div>
    </div>
    @if(session('lockout_seconds'))
        <script>
            let seconds = {{ session('lockout_seconds') }};
            const countdown = document.getElementById('countdown');
            const loginBtn = document.getElementById('loginBtn');
            const loginForm = document.getElementById('loginForm');

            // Disable login button
            loginBtn.disabled = true;

            const interval = setInterval(() => {
                seconds--;
                if(seconds > 0){
                    countdown.textContent = `Please wait ${seconds} seconds before trying again.`;
                } else {
                    countdown.textContent = '';
                    loginBtn.disabled = false;
                    clearInterval(interval);
                }
            }, 1000);
        </script>
    @endif
@endsection
