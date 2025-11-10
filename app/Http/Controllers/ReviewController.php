<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
public function index($property_id)
{
$property = Property::with(['images', 'reviews.user'])->findOrFail($property_id);

// Compute average & breakdown
$avgRating = $property->reviews->avg('overall_rating');
$ratingCounts = [];
for ($i = 1; $i <= 5; $i++) {
$ratingCounts[$i] = $property->reviews->where('overall_rating', '>=', $i - 0.5)
->where('overall_rating', '<', $i + 0.5)
->count();
}

return view('reviews.index', compact('property', 'avgRating', 'ratingCounts'));
}

public function store(Request $request, $property_id)
{
$validated = $request->validate([
'title' => 'required|string|max:255',
'review' => 'required|string',
'cleanliness' => 'required|integer|min:1|max:5',
'location' => 'required|integer|min:1|max:5',
'price' => 'required|integer|min:1|max:5',
]);

$validated['user_id'] = auth()->id();
$validated['property_id'] = $property_id;
$validated['overall_rating'] = (
$validated['cleanliness'] + $validated['location'] + $validated['price']
) / 3;

Review::create($validated);

return redirect()->route('reviews.index', $property_id)
->with('success', 'Your review has been submitted successfully!');
}


}
