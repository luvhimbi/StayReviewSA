@extends('layouts.app')

@section('title', 'Verify Your Email')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 p-6">
        <div class="bg-white w-full max-w-md rounded-lg shadow-md p-8 text-center">
            <h2 class="text-2xl font-bold mb-4">Verify Your Email</h2>
            <p class="text-gray-700 mb-6">
                A verification link has been sent to your email address. Please click the link in the email to verify your account.
            </p>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Resend Verification Email
                </button>
            </form>
        </div>
    </div>
@endsection
