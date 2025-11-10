@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-100 p-6">
        <div class="bg-white w-full max-w-lg overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Create Your Account</h2>
                    <p class="text-gray-500">Join us and start your journey today!</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">First Name</label>
                            <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="John"
                                   class="w-full px-4 py-2 border border-gray-300  focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                            @error('firstname') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Last Name</label>
                            <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Doe"
                                   class="w-full px-4 py-2 border border-gray-300  focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                            @error('lastname') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                               class="w-full px-4 py-2 border border-gray-300  focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Password</label>
                            <input type="password" name="password" placeholder="********"
                                   class="w-full px-4 py-2 border border-gray-300  focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                            @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" placeholder="********"
                                   class="w-full px-4 py-2 border border-gray-300  focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3  transition transform hover:scale-[1.02] shadow-md">
                        Create Account
                    </button>

                    <!-- Terms of Service & Privacy Policy notice -->
                    <p class="text-center text-sm text-gray-500 mt-3">
                        By registering, you agree to our
                        <a href="{{ route('terms') }}" class="text-indigo-600 hover:underline">Terms of Service</a>
                        and
                        <a href="{{ route('privacy') }}" class="text-indigo-600 hover:underline">Privacy Policy</a>.
                    </p>

                    <div class="text-center mt-5">
                        <p class="text-gray-600">Already have an account?
                            <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
