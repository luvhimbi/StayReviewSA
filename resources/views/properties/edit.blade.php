@extends('layouts.navbar')

@section('title', 'Edit Property')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-blue-600 mb-6 flex items-center gap-2">
            <i class="bi bi-pencil-square"></i> Edit Property
        </h2>

        <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Property Name</label>
                    <input type="text" name="property_name" value="{{ old('property_name', $property->property_name) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address', $property->address) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input type="text" name="city" value="{{ old('city', $property->city) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">State</label>
                    <input type="text" name="state" value="{{ old('state', $property->state) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                    <input type="text" name="country" value="{{ old('country', $property->country) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Property Type</label>
                    <select name="property_type"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="apartment" {{ $property->property_type === 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="house" {{ $property->property_type === 'house' ? 'selected' : '' }}>House</option>
                        <option value="studio" {{ $property->property_type === 'studio' ? 'selected' : '' }}>Studio</option>
                        <option value="room" {{ $property->property_type === 'room' ? 'selected' : '' }}>Room</option>
                    </select>
                </div>
            </div>

            <!-- Approve & Verified checkboxes -->
            <div class="flex items-center space-x-6">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="approved" value="1" {{ $property->approved ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <span class="text-sm text-gray-700">Approved</span>
                </label>

                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="verified" value="1" {{ $property->verified ? 'checked' : '' }} class="h-4 w-4 text-green-600 border-gray-300 rounded">
                    <span class="text-sm text-gray-700">Verified</span>
                </label>
            </div>

            <!-- Main Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Main Image</label>
                @if($property->main_image)
                    <img src="{{ asset('storage/' . $property->main_image) }}" class="w-32 h-24 rounded-md shadow mb-2 object-cover" alt="Property Image">
                @endif
                <input type="file" name="main_image" class="w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Action buttons -->
            <div class="flex justify-between">
                <a href="{{ route('properties.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">Update</button>
            </div>
        </form>
    </div>
@endsection
