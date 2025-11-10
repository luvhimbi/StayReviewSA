@extends('layouts.navbar')

@section('title', $property->property_name . ' Details')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12 px-4 flex justify-center">
        <div class="w-full max-w-6xl bg-white rounded-xl shadow-lg overflow-hidden grid md:grid-cols-3 gap-8">

            <!-- Left: Property Details -->
            <div class="md:col-span-2">
                <!-- Property Main Image -->
                <div class="relative">
                    <img src="{{ asset('storage/' . $property->main_image) }}"
                         alt="{{ $property->property_name }}"
                         class="w-full h-80 object-cover">

                    <!-- Verified/Pending Badge -->
                    <span class="absolute top-4 right-4 px-4 py-1 text-sm font-semibold rounded-full
                    {{ $property->verified ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                    {{ $property->verified ? 'Verified Property' : 'Pending Verification' }}
                </span>
                </div>

                <!-- Property Info -->
                <div class="p-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $property->property_name }}</h1>
                    <p class="text-gray-600 mb-4">{{ $property->address }}, {{ $property->city }}, {{ $property->state }}, {{ $property->country }}</p>

                    <div class="grid sm:grid-cols-2 gap-6 mb-8">
                        <div>
                            <p class="text-gray-700 mb-2">
                                <span class="font-semibold">Type:</span> {{ ucfirst($property->property_type) }}
                            </p>
                            <p class="text-gray-700 mb-2">
                                <span class="font-semibold">Posted By:</span>
                                {{ $property->poster->firstname ?? 'Unknown' }} {{ $property->poster->lastname ?? '' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-700 mb-2">
                                <span class="font-semibold">Status:</span>
                                @if ($property->approved)
                                    <span class="text-green-600 font-semibold">Approved</span>
                                @else
                                    <span class="text-yellow-600 font-semibold">Pending Approval</span>
                                @endif
                            </p>
                            <p class="text-gray-700 mb-2">
                                <span class="font-semibold">Added On:</span> {{ $property->created_at->format('F d, Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Gallery -->
                    @if ($property->images->count())
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Gallery</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 mb-8">
                            @foreach ($property->images as $img)
                                <img src="{{ asset('storage/' . $img->image_url) }}"
                                     alt="Property Image"
                                     class="rounded-lg object-cover h-40 w-full hover:scale-105 transform transition">
                            @endforeach
                        </div>
                    @endif

                    <!-- Buttons -->
                    <div class="flex flex-wrap justify-center gap-4 mt-6">
                        <a href="{{ route('user.dashboard') }}"
                           class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition">
                            ← Back to Dashboard
                        </a>

                        <a id="writeReviewBtn"
                           href="{{ route('reviews.index', $property->id) }}"
                           class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition shadow-md">
                            Write a Review
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Ratings + Reviews -->
            <div class="p-6 border-l border-gray-200 bg-gray-50" id="reviews">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Ratings & Reviews</h2>

                <!-- Average Rating -->
                <div class="text-center mb-6">
                    <div class="text-5xl font-bold text-yellow-500">{{ number_format($averageRating, 1) }}</div>
                    <div class="text-gray-600">out of 5</div>

                    <!-- Display stars visually -->
                    <div class="flex justify-center mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="text-yellow-400 text-2xl">
                            {!! $i <= round($averageRating) ? '★' : '☆' !!}
                        </span>
                        @endfor
                    </div>
                    <div class="text-gray-500 text-sm mt-1">{{ $property->reviews->count() }} reviews</div>
                </div>

                <!-- Star Breakdown -->
                <div class="space-y-1 mb-8">
                    @for ($i = 5; $i >= 1; $i--)
                        <div class="flex items-center justify-between text-sm text-gray-700">
                            <span>{{ $i }} star</span>
                            <div class="flex-1 mx-2 bg-gray-200 h-2 rounded-full">
                                <div class="bg-yellow-400 h-2 rounded-full"
                                     style="width: {{ $property->reviews->count() ? ($stars[$i] / $property->reviews->count()) * 100 : 0 }}%"></div>
                            </div>
                            <span>{{ $stars[$i] }}</span>
                        </div>
                    @endfor
                </div>

                <!-- Review List -->
                @if ($property->reviews->isEmpty())
                    <p class="text-gray-600 text-center">No reviews yet. Be the first to write one!</p>
                @else
                    <div class="space-y-6">
                        @foreach ($property->reviews as $review)
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="font-semibold text-gray-800">{{ $review->title }}</h3>
                                    <span class="text-yellow-500 font-bold">{{ number_format($review->overall_rating, 1) }}★</span>
                                </div>
                                <p class="text-gray-700 mb-2">{{ $review->review }}</p>
                                <p class="text-sm text-gray-500">by {{ $review->user->firstname ?? 'Anonymous' }}
                                    on {{ $review->created_at->format('M d, Y') }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
