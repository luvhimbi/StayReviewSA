@extends('layouts.navbar')

@section('title', isset($user) ? 'Edit User' : 'Add User')

@section('content')
    <div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-blue-600 mb-6">
            {{ isset($user) ? 'Edit User' : 'Add User' }}
        </h2>

        <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            @if(isset($user)) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="firstname" placeholder="First Name" value="{{ old('firstname', $user->firstname ?? '') }}" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                <input type="text" name="lastname" placeholder="Last Name" value="{{ old('lastname', $user->lastname ?? '') }}" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                <input type="email" name="email" placeholder="Email" value="{{ old('email', $user->email ?? '') }}" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                <select name="role" class="w-full border border-gray-300 rounded-md px-3 py-2" required>
                    <option value="user" {{ (old('role', $user->role ?? '') == 'user') ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Admin</option>
                </select>
                <input type="password" name="password" placeholder="{{ isset($user) ? 'Leave blank to keep current' : 'Password' }}" class="w-full border border-gray-300 rounded-md px-3 py-2" {{ isset($user) ? '' : 'required' }}>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full border border-gray-300 rounded-md px-3 py-2" {{ isset($user) ? '' : 'required' }}>
            </div>

            <div class="flex gap-4 mt-2">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="popi_consent" value="1" {{ isset($user) && $user->popi_consent ? 'checked' : '' }}>
                    Popi Consent
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_two_factor_enabled" value="1" {{ isset($user) && $user->is_two_factor_enabled ? 'checked' : '' }}>
                    Two-Factor Auth
                </label>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">{{ isset($user) ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
@endsection
