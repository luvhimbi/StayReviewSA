@extends('layouts.navbar')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8">Welcome back, {{ $user->firstname }} {{$user->lastname}}</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Users Card -->
            <a href="{{ route('admin.users.index') }}" class="block bg-white shadow-lg rounded-xl p-6 border-t-4 border-blue-500 hover:shadow-2xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Total Users</h2>
                        <p class="text-4xl font-bold text-blue-600 mt-2">{{ $userCount }}</p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h5M12 12a5 5 0 100-10 5 5 0 000 10z" />
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Properties Card -->
            <a href="{{ route('properties.index') }}" class="block bg-white shadow-lg rounded-xl p-6 border-t-4 border-green-500 hover:shadow-2xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Total Properties</h2>
                        <p class="text-4xl font-bold text-green-600 mt-2">{{ $propertyCount }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 001 1h3m-10 0h4" />
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Reviews Card -->
            <div class="bg-white shadow-lg rounded-xl p-6 border-t-4 border-yellow-500 hover:shadow-2xl transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700">Total Reviews</h2>
                        <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $reviewCount }}</p>
                    </div>
                    <div class="bg-yellow-100 p-4 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3m6 0a3 3 0 01-3 3m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
