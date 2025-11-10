@extends('layouts.navbar')

@section('title', 'All Properties')

@section('content')
    <div class="flex justify-center items-start min-h-screen bg-gray-100 px-4 ">
        <div class="w-full max-w-7xl">

            <!-- Top Section with Search -->
            <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 p-8 shadow-xl text-center w-full rounded-xl mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome to Stay Review!</h1>
                <p class="text-gray-600 mb-6">Find your next place. Know the full story before you move in.</p>

                <!-- Search Bar -->
                <form action="{{ route('user.dashboard') }}" method="GET" class="flex items-center justify-center mb-6 bg-white overflow-hidden w-full mx-auto max-w-3xl rounded-full">
                    <input
                        type="text"
                        name="query"
                        value="{{ $query ?? '' }}"
                        placeholder="Search for a property..."
                        class="flex-1 px-4 py-2 focus:ring-2 focus:ring-indigo-400 focus:outline-none rounded-l-full"
                    >
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 hover:bg-indigo-700 transition rounded-r-full">
                        Search
                    </button>
                </form>

                <!-- Add Property Link -->
                <p class="text-gray-700 mt-4">
                    Can't find the property you want to review?
                    <a href="{{ route('properties.create') }}" class="text-indigo-600 font-semibold hover:underline ml-1">
                        Add it here
                    </a>.
                </p>
            </div>


            <!-- Properties Grid -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">All Properties</h2>

            @if ($properties->isEmpty())
                <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 p-4 rounded text-center">
                    <p>No properties found{{ $query ? " for \"{$query}\"" : '' }}.</p>
                </div>
            @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($properties as $property)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden border hover:shadow-lg transition">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $property->main_image) }}"
                                     alt="{{ $property->property_name }}"
                                     class="w-full h-48 object-cover">

                                <!-- Verified / Pending Badge -->
                                <span class="absolute top-3 right-3 px-3 py-1 text-xs font-semibold rounded-full
                                {{ $property->verified ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $property->verified ? 'Verified' : 'Pending' }}
                                </span>
                            </div>

                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $property->property_name }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $property->city }}, {{ $property->state }}</p>

                                <!-- Rating Stars and Review Count -->
                                <div class="flex items-center mb-2">
                                    <div class="flex text-yellow-400 mr-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            {!! $i <= round($property->averageRating) ? '★' : '☆' !!}
                                        @endfor
                                    </div>
                                    <span class="text-gray-600 text-sm">({{ $property->reviewCount }} review{{ $property->reviewCount != 1 ? 's' : '' }})</span>
                                </div>

                                <p class="text-sm mb-3">
                                    <span class="font-medium text-gray-700">Type:</span> {{ ucfirst($property->property_type) }}
                                </p>

                                @if ($property->images->count())
                                    <div class="grid grid-cols-3 gap-2 mt-3 mb-4">
                                        @foreach ($property->images->take(3) as $img)
                                            <img src="{{ asset('storage/' . $img->image_url) }}"
                                                 alt="Additional Image"
                                                 class="rounded-lg object-cover h-20 w-full">
                                        @endforeach
                                    </div>
                                @endif

                                <!-- View Details Button -->
                                <div class="text-center mt-3">
                                    <a href="{{ route('properties.show', $property->id) }}"
                                       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-8 flex justify-center">
                    {{ $properties->links('vendor.pagination.tailwind') }}
                </div>
            @endif

        </div>
    </div>
@endsection
