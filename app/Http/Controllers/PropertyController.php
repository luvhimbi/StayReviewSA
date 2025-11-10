<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'property_type' => 'required|in:apartment,house,studio,room',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save main image
        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('properties/main', 'public');
        }

        // Create property
        $property = Property::create([
            'poster_id' => Auth::id(),
            'property_name' => $request->property_name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'property_type' => $request->property_type,
            'main_image' => $mainImagePath,
        ]);

        // Upload additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties/images', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_url' => $path,
                ]);
            }
        }
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('properties.index')
                ->with('success', 'Property added successfully and is now visible to all.');
        }  else {
            return redirect()->route('user.dashboard')
                ->with('success', 'Property submitted successfully. Await approval.');
        }
    }

    public function show($id)
    {
        $property = Property::with(['images', 'reviews.user'])->findOrFail($id);

        // Calculate rating stats
        $averageRating = $property->reviews()->avg('overall_rating') ?? 0;
        $ratingCounts = $property->reviews()
            ->selectRaw('overall_rating, COUNT(*) as count')
            ->groupBy('overall_rating')
            ->pluck('count', 'overall_rating');

        // Fill missing star counts (1–5)
        $stars = [];
        for ($i = 1; $i <= 5; $i++) {
            $stars[$i] = $ratingCounts[$i] ?? 0;
        }

        return view('properties.show', compact('property', 'averageRating', 'stars'));
    }

    public function propertiesBasedOnProvinces()
    {
        // Define all South African provinces
        $provinces = [
            'Eastern Cape', 'Free State', 'Gauteng', 'KwaZulu-Natal', 'Limpopo',
            'Mpumalanga', 'Northern Cape', 'North West', 'Western Cape'
        ];

        // Get all properties and group them by state
        $propertiesByState = Property::select('id', 'property_name', 'state')
            ->get()
            ->groupBy('state');

        return view('properties.provinces', compact('provinces', 'propertiesByState'));
    }

    public function index()
    {
        // Fetch all properties with their poster details
        $properties = \App\Models\Property::with('poster')->orderBy('created_at', 'desc')->get();

        // Pass them to the admin properties view
        return view('properties.index', compact('properties'));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $request->validate([
            'property_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'property_type' => 'required|in:apartment,house,studio,room',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ✅ Update main image if uploaded
        if ($request->hasFile('main_image')) {
            if ($property->main_image) {
                Storage::delete('public/' . $property->main_image);
            }
            $property->main_image = $request->file('main_image')->store('properties/main', 'public');
        }

        // ✅ Update basic fields
        $property->update([
            'property_name' => $request->property_name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'property_type' => $request->property_type,
            'approved' => $request->has('approved'),
            'verified' => $request->has('verified'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('properties/images', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_url' => $path,
                ]);
            }
        }


//        if ($request->has('delete_images')) {
//            foreach ($request->delete_images as $imageId) {
//                $image = PropertyImage::find($imageId);
//                if ($image) {
//                    Storage::delete('public/' . $image->image_url);
//                    $image->delete();
//                }
//            }
//        }

        return redirect()->route('properties.index')
            ->with('success', 'Property updated successfully.');
    }


    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.edit', compact('property'));
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        if ($property->main_image && Storage::disk('public')->exists($property->main_image)) {
            Storage::disk('public')->delete($property->main_image);
        }

        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Property deleted successfully.');
    }

}
