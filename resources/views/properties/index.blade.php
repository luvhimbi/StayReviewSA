@extends('layouts.navbar')

@section('title', 'All Properties')

@section('content')
    <div class="max-w-7xl mt-10 ">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                <i class="bi bi-building"></i> All Properties
            </h2>

            <a href="{{ route('properties.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 transition duration-200">
                <i class="bi bi-plus-lg mr-2"></i> Add Property
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
                <thead class="bg-blue-600 text-white uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Property Name</th>
                    <th class="px-4 py-3">Poster</th>
                    <th class="px-4 py-3">Address</th>
                    <th class="px-4 py-3">City</th>
                    <th class="px-4 py-3">State</th>
                    <th class="px-4 py-3">Country</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Approved</th>
                    <th class="px-4 py-3">Verified</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse ($properties as $index => $property)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $property->property_name }}</td>
                        <td class="px-4 py-3">
                            @if($property->poster)
                                {{ $property->poster->firstname }} {{ $property->poster->lastname }}
                            @else
                                <span class="text-gray-400 italic">N/A</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $property->address }}</td>
                        <td class="px-4 py-3">{{ $property->city }}</td>
                        <td class="px-4 py-3">{{ $property->state }}</td>
                        <td class="px-4 py-3">{{ $property->country }}</td>
                        <td class="px-4 py-3">{{ ucfirst($property->property_type) }}</td>
                        <td class="px-4 py-3">
                            @if($property->approved)
                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Yes</span>
                            @else
                                <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-1 rounded">No</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($property->verified)
                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Yes</span>
                            @else
                                <span class="bg-gray-200 text-gray-700 text-xs font-semibold px-2 py-1 rounded">No</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('properties.edit', $property->id) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white rounded-lg text-xs font-semibold hover:bg-yellow-500 transition">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this property?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-semibold hover:bg-red-600 transition">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="px-4 py-6 text-center text-gray-400">No properties found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
