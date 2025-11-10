@extends('layouts.navbar')

@section('title', 'Legal')

@section('content')
    <div class="max-w-4xl mx-auto mt-12 px-6">
        <h1 class="text-3xl font-semibold mb-6">Legal Information</h1>

        <p class="text-gray-700 mb-6">
            Welcome to the legal section. Here you can find all the policies and terms that govern the use of this platform.
        </p>

        <div class="space-y-4">
            <a href="{{ route('terms') }}" class="block p-4 border border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                <h2 class="text-xl font-semibold text-blue-600">Terms of Service</h2>
                <p class="text-gray-700">Read the rules and conditions for using our platform.</p>
            </a>

            <a href="{{ route('privacy') }}" class="block p-4 border border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                <h2 class="text-xl font-semibold text-blue-600">Privacy Policy</h2>
                <p class="text-gray-700">Learn how we collect, use, and protect your personal information.</p>
            </a>

            <a href="{{ route('popi') }}" class="block p-4 border border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                <h2 class="text-xl font-semibold text-blue-600">POPI Act Consent</h2>
                <p class="text-gray-700">Understand the POPI Act and provide consent for data processing.</p>
            </a>
        </div>
    </div>
@endsection
