@extends('layouts.navbar')

@section('title', 'Add Property')

@section('content')
    <div class="max-w-3xl mx-auto py-12 px-4">
        <h2 class="text-2xl font-semibold mb-4">Add a Property</h2>
        <p class="text-gray-600 mb-6">
            Fill in the details of your property. <span class="font-semibold text-red-500">The property will only be visible on the platform after verification by our team.</span>
        </p>

        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Property Name -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Property Name</label>
                <input type="text" name="property_name" value="{{ old('property_name') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('property_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Address, City, Province, Country -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Province</label>
                    <select name="state" class="w-full px-4 py-2 border rounded-lg">
                        @php
                            $provinces = [
                                'Eastern Cape','Free State','Gauteng','KwaZulu-Natal','Limpopo',
                                'Mpumalanga','Northern Cape','North West','Western Cape'
                            ];
                        @endphp
                        <option value="">Select Province</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province }}" {{ old('state') == $province ? 'selected' : '' }}>
                                {{ $province }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Country</label>
                    <input type="text" name="country" value="{{ old('country', 'South Africa') }}" class="w-full px-4 py-2 border rounded-lg" readonly>
                </div>
            </div>

            <!-- Property Type -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Property Type</label>
                <select name="property_type" class="w-full px-4 py-2 border rounded-lg">
                    <option value="apartment" {{ old('property_type')=='apartment' ? 'selected' : '' }}>Apartment</option>
                    <option value="house" {{ old('property_type')=='house' ? 'selected' : '' }}>House</option>
                    <option value="studio" {{ old('property_type')=='studio' ? 'selected' : '' }}>Studio</option>
                    <option value="room" {{ old('property_type')=='room' ? 'selected' : '' }}>Room</option>
                </select>
            </div>

            <!-- Main Image -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Main Image</label>
                <input type="file" name="main_image" class="w-full border rounded-lg p-2">
                <p class="text-gray-500 text-sm mt-1">This image will represent your property prominently.</p>
            </div>

            <!-- Additional Images -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Additional Images</label>
                <div class="border rounded-lg p-3 bg-gray-50 flex flex-col gap-2">
                    <input type="file" name="images[]" multiple class="w-full">
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                Submit Property
            </button>
        </form>
    </div>
@endsection
