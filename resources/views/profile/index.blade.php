@extends('layouts.navbar')

@section('title', 'My Profile')

@section('content')
    <div class="bg-gray-100 min-h-screen py-12 px-4">


        <div class="max-w-6xl mx-auto space-y-12">

            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 text-green-700 px-6 py-4 rounded shadow-md text-center font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Profile Section -->
            <section class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 p-6 text-center">
                    <h2 class="text-3xl font-bold text-white">My Profile</h2>
                    <p class="text-indigo-100 mt-1">View and manage your account details</p>
                </div>
                <div class="p-8 grid sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-700 font-medium">First Name</p>
                        <p class="text-gray-900">{{ $user->firstname }}</p>
                    </div>
                    <div>
                        <p class="text-gray-700 font-medium">Last Name</p>
                        <p class="text-gray-900">{{ $user->lastname }}</p>
                    </div>
                    <div>
                        <p class="text-gray-700 font-medium">Email</p>
                        <p class="text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-700 font-medium">Role</p>
                        <p class="text-gray-900">{{ ucfirst($user->role) }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-gray-700 font-medium">Member Since</p>
                        <p class="text-gray-900">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
                <div class="text-center p-6 border-t border-gray-200">
                    <a href="{{ route('profile.edit') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl shadow-md transition transform hover:scale-[1.02]">
                        Edit Profile
                    </a>
                </div>
            </section>
@if(auth()->user()->role === 'user')
            <!-- Tab Navbar -->
            <section class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="flex border-b border-gray-200">
                    <button id="propertiesTab" class="flex-1 text-center py-3 font-semibold text-gray-800 border-b-2 border-indigo-600 focus:outline-none">
                        My Properties
                    </button>
                    <button id="reviewsTab" class="flex-1 text-center py-3 font-semibold text-gray-800 border-b-2 border-transparent hover:border-indigo-400 focus:outline-none">
                        My Reviews
                    </button>
                </div>

                <!-- Properties Content -->
                <div id="propertiesContent" class="p-6">
                    @if ($properties->isEmpty())
                        <p class="text-gray-600 text-center">You haven’t added any properties yet.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($properties as $property)
                                <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/' . $property->main_image) }}" alt="{{ $property->property_name }}" class="w-24 h-24 object-cover rounded-lg">
                                        <div>
                                            <h3 class="font-semibold text-lg text-gray-800">{{ $property->property_name }}</h3>
                                            <p class="text-gray-600 text-sm">{{ $property->city }}, {{ $property->state }}</p>
                                            <p class="text-gray-600 text-sm mt-1">
                                                <span class="font-medium">Type:</span> {{ ucfirst($property->property_type) }}
                                            </p>
                                            <div class="flex items-center mt-1 text-yellow-400">
                                                @for ($i=1; $i<=5; $i++)
                                                    {!! $i <= round($property->averageRating) ? '★' : '☆' !!}
                                                @endfor
                                                <span class="text-gray-600 ml-2 text-sm">({{ $property->reviewCount }} review{{ $property->reviewCount != 1 ? 's' : '' }})</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 md:mt-0">
                                        <a href="{{ route('properties.show', $property->id) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition shadow-sm">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Reviews Content -->
                <div id="reviewsContent" class="p-6 hidden">
                    @if ($reviews->isEmpty())
                        <p class="text-gray-600 text-center">You haven't written any reviews yet.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($reviews as $review)
                                <div class="bg-gray-50 rounded-lg shadow-sm p-4">
                                    <div class="flex justify-between items-center mb-1">
                                        <h3 class="font-semibold text-gray-800">{{ $review->review_title }}</h3>
                                        <span class="text-yellow-500 font-bold">{{ number_format($review->overall_rating, 1) }}★</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mb-2">
                                        On <a href="{{ route('properties.show', $review->property->id) }}" class="text-indigo-600 hover:underline">
                                            {{ $review->property->property_name }}
                                        </a> • {{ $review->created_at->diffForHumans() }}
                                    </p>
                                    <p class="text-gray-700">{{ $review->review }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </section>
            @endif
        </div>
    </div>

    <!-- Tab Toggle Script -->
    <script>
        const propertiesTab = document.getElementById('propertiesTab');
        const reviewsTab = document.getElementById('reviewsTab');
        const propertiesContent = document.getElementById('propertiesContent');
        const reviewsContent = document.getElementById('reviewsContent');

        propertiesTab.addEventListener('click', () => {
            propertiesContent.classList.remove('hidden');
            reviewsContent.classList.add('hidden');
            propertiesTab.classList.add('border-indigo-600');
            reviewsTab.classList.remove('border-indigo-600');
        });

        reviewsTab.addEventListener('click', () => {
            reviewsContent.classList.remove('hidden');
            propertiesContent.classList.add('hidden');
            reviewsTab.classList.add('border-indigo-600');
            propertiesTab.classList.remove('border-indigo-600');
        });
    </script>
@endsection
