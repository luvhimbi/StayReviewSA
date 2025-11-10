@extends('layouts.app')

@section('title', 'POPI Act Consent')

@section('content')

    <div class="max-w-3xl mx-auto mt-12 px-6">
        <nav class="text-gray-500 text-sm mb-6" aria-label="Breadcrumb">
            <ol class="list-reset flex">
                <li>
                    <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">Back</a>
                </li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-700">Privacy Policy</li>
            </ol>
        </nav>
        <h1 class="text-3xl font-semibold mb-6">POPI Act Consent</h1>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        @if(session('info'))
            <div class="bg-blue-100 text-blue-800 px-4 py-3 rounded mb-4">
                {{ session('info') }}
            </div>
        @endif
        <p class="text-gray-700 mb-4">
            The Protection of Personal Information Act (POPI Act) requires us to protect your personal information and ensure that it is processed lawfully and responsibly.
            By consenting, you allow us to collect, store, and process your personal information to provide and improve our services.
        </p>

        <h2 class="text-2xl font-semibold mt-6 mb-2">What We Collect</h2>
        <p class="text-gray-700 mb-4">
            We may collect:
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>Your name, email address, and contact information</li>
            <li>Account and profile information you provide</li>
            <li>Messages and interactions with other users</li>
            <li>Usage data such as login times and activity on the platform</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-6 mb-2">How We Use Your Information</h2>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>To provide and maintain the platform services</li>
            <li>To improve user experience and features</li>
            <li>To communicate important updates and notifications</li>
            <li>To comply with legal and regulatory obligations</li>
        </ul>

        <h2 class="text-2xl font-semibold mt-6 mb-2">Your Rights</h2>
        <p class="text-gray-700 mb-4">
            Under the POPI Act, you have the right to:
        </p>
        <ul class="list-disc list-inside text-gray-700 mb-4">
            <li>Access the personal information we hold about you</li>
            <li>Request corrections to inaccurate or incomplete information</li>
            <li>Withdraw consent for processing your personal information</li>
            <li>Request deletion of your personal information where applicable</li>
        </ul>

        <p class="text-gray-700 mb-6">
            For more details on how we protect your information, please read our
            <a href="{{ route('privacy') }}" class="text-blue-600 hover:underline">Privacy Policy</a>.
        </p>

        <form method="POST" action="{{ route('popi.accept') }}">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                I Consent
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-500">
            You can also review our
            <a href="{{ route('terms') }}" class="text-blue-600 hover:underline">Terms of Service</a>.
        </p>
    </div>
@endsection
