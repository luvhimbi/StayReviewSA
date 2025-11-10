@extends('layouts.navbar')

@section('title', 'Reviews for ' . $property->property_name)

@section('content')
    <div class="min-h-screen bg-gray-100 py-10 px-6">
        <div class="max-w-6xl mx-auto">
            <!-- Property Header -->
            <div class="bg-white p-6 rounded-lg shadow mb-6 flex flex-col md:flex-row items-center">
                <img src="{{ asset('storage/' . $property->main_image) }}"
                     alt="{{ $property->property_name }}"
                     class="w-48 h-36 object-cover rounded-lg mr-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $property->property_name }}</h1>
                    <p class="text-gray-600">{{ $property->address }}, {{ $property->city }}, {{ $property->state }}</p>
                    <p class="mt-2 text-lg">
                        ⭐ <span class="font-semibold text-yellow-500">{{ number_format($avgRating ?? 0, 1) }}</span> / 5 ({{ $property->reviews->count() }} reviews)
                    </p>
                </div>
            </div>

            <!-- Rating Breakdown -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-lg font-semibold mb-4">Rating Breakdown</h2>
                @foreach([5,4,3,2,1] as $star)
                    <div class="flex items-center mb-2">
                        <span class="w-10 text-gray-700 font-medium">{{ $star }}★</span>
                        <div class="flex-1 bg-gray-200 h-3 rounded-full mx-2">
                            <div class="bg-yellow-400 h-3 rounded-full"
                                 style="width: {{ $property->reviews->count() ? ($ratingCounts[$star] / $property->reviews->count()) * 100 : 0 }}%">
                            </div>
                        </div>
                        <span class="text-gray-600">{{ $ratingCounts[$star] }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Review Form -->
            <div class="bg-white p-6 rounded-lg shadow mb-10">
                <h2 class="text-lg font-semibold mb-4">Write a Review</h2>

                <form action="{{ route('reviews.store', $property->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid sm:grid-cols-3 gap-4">
                        @foreach(['cleanliness', 'location', 'price'] as $field)
                            <div>
                                <label class="font-medium text-gray-700 capitalize">{{ $field }}</label>
                                <div class="flex space-x-1 mt-1">
                                    @for($i=1; $i<=5; $i++)
                                        <input type="radio" name="{{ $field }}" value="{{ $i }}" id="{{ $field.$i }}" class="hidden peer" required>
                                        <label for="{{ $field.$i }}" class="cursor-pointer text-2xl text-gray-300 hover:text-yellow-400 peer-checked:text-yellow-500">
                                            ★
                                        </label>
                                    @endfor
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div>
                        <label class="font-medium text-gray-700">Review Title</label>
                        <input type="text" name="title" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-400" required>
                    </div>

                    <div>
                        <label class="font-medium text-gray-700">Your Review</label>
                        <textarea name="review" rows="4" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-400" required></textarea>
                    </div>

                    <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition shadow-md">
                        Submit Review
                    </button>
                </form>
            </div>

            <!-- Reviews List -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-4">All Reviews</h2>

                @forelse($property->reviews as $review)
                    <div class="border-b border-gray-200 py-4">
                        <h3 class="font-semibold text-gray-800">{{ $review->review_title }}</h3>
                        <p class="text-gray-600 text-sm mb-1">By {{ $review->user->firstname ?? 'Anonymous' }} • {{ $review->created_at->diffForHumans() }}</p>
                        <div class="text-yellow-500 mb-2">
                            @for($i=1; $i<=5; $i++)
                                <span>{{ $i <= round($review->overall_rating) ? '★' : '☆' }}</span>
                            @endfor
                        </div>
                        <p class="text-gray-700">{{ $review->review }}</p>
                    </div>
                @empty
                    <p class="text-gray-600 text-center py-6">No reviews yet. Be the first to share your experience!</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
