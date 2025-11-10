@extends('layouts.navbar')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl mx-auto mt-12 px-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Edit Profile</h1>

        {{-- Profile Info Form --}}
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf

            <div class="flex flex-col md:flex-row md:space-x-6">
                <div class="flex-1">
                    <label class="block text-gray-700 mb-2 font-medium">First Name</label>
                    <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500">
                    @error('firstname') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex-1 mt-4 md:mt-0">
                    <label class="block text-gray-700 mb-2 font-medium">Last Name</label>
                    <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500">
                    @error('lastname') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Save Changes
                </button>
                <a href="{{ route('profile.index') }}" class="text-gray-600 hover:text-gray-800 transition">Cancel</a>
            </div>
        </form>

        {{-- Divider --}}
        <hr class="my-10 border-gray-300">

        {{-- Password Change Form --}}
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Change Password</h2>
        <form method="POST" action="{{ route('profile.password') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Current Password</label>
                <input type="password" name="current_password" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-500">
                @error('current_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">New Password</label>
                <input type="password" name="new_password" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-500">
                @error('new_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-2 font-medium">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-500">
            </div>

            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                Change Password
            </button>
        </form>
    </div>
@endsection
