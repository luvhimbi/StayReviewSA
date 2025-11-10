@extends('layouts.navbar')

@section('title', 'Settings')

@section('content')
    <div class="max-w-4xl mx-auto mt-12 px-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Settings</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-6">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
            @csrf

            {{-- Theme Selection Example --}}
            <div>
                <label class="block text-gray-700 mb-2 font-medium">Notifications</label>
                <input type="checkbox" name="notifications" value="1" {{ $user->notifications ? 'checked' : '' }} class="h-5 w-5 text-blue-600">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Save Settings
            </button>
        </form>
        <hr class="my-10 border-gray-300">

        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Two-Factor Authentication (2FA)</h2>

            @if($user->is_two_factor_enabled)
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
                    ✅ 2FA is currently enabled. You’ll receive an OTP via email when logging in.
                </div>
            @else
                <div class="bg-yellow-100 text-yellow-700 p-4 rounded-lg mb-4">
                    ⚠️ 2FA is currently disabled. Enable it for added security.
                </div>
            @endif

            <form method="POST" action="{{ route('settings.toggle2fa') }}">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    {{ $user->is_two_factor_enabled ? 'Disable 2FA' : 'Enable 2FA' }}
                </button>
            </form>
        </div>


        {{-- Divider --}}
        <hr class="my-10 border-gray-300">

        {{-- Account Deactivation --}}
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Account</h2>
            <button
                id="deactivateBtn"
                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
                Delete Account
            </button>
        </div>
    </div>

    {{-- Modal --}}
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Confirm Deactivation</h3>
            <p class="text-gray-700 mb-6">Are you sure you want to deactivate your account? This action cannot be undone.</p>
            <div class="flex justify-end space-x-4">
                <button id="cancelModal" class="px-4 py-2 rounded-lg bg-gray-300 hover:bg-gray-400 transition">Cancel</button>

                <form method="POST" action="{{ route('profile.delete') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">Yes, Deactivate</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Script --}}
    <script>
        const modal = document.getElementById('modal');
        const deactivateBtn = document.getElementById('deactivateBtn');
        const cancelModal = document.getElementById('cancelModal');

        deactivateBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        });

        cancelModal.addEventListener('click', () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        });
    </script>
@endsection
