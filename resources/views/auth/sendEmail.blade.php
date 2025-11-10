@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-blue-100 to-indigo-100 p-6">
        <div class="bg-white  w-full max-w-lg overflow-hidden">
            <div class="p-8 sm:p-10">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Reset Your Password </h2>
                    <p class="text-gray-500">Enter your email to receive reset instructions</p>
                </div>

                @if (session('success'))
                    <div class="mb-4 text-green-600 text-center font-semibold bg-green-50 border border-green-200 p-2 rounded-xl">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('reset.email') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                               class="w-full px-4 py-2 border border-gray-300  focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit"
                            class="w-full mt-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 transition transform hover:scale-[1.02] shadow-md">
                        Send Reset Email
                    </button>

                    <div class="text-center mt-5">
                        <a href="{{ route('login') }}" class="text-indigo-600 font-medium hover:underline">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
