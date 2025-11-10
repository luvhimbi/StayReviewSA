@extends('layouts.navbar')

@section('title', 'Properties by Province')

@section('content')
    <div class="bg-gray-100 min-h-screen">

        <!-- Page Header -->
        <div class="bg-white shadow py-6">
            <div class="max-w-6xl mx-auto px-4 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Properties by Province</h1>
                <p class="text-gray-600 mt-2">Click a province to jump to properties in that area</p>
            </div>
        </div>

        <!-- Provinces Menu -->
        <div class="bg-white shadow mt-6">
            <div class="max-w-6xl mx-auto px-4 py-4 flex flex-wrap justify-center gap-4">
                @foreach($provinces as $province)
                    <a href="#province-{{ Str::slug($province) }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                        {{ $province }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Properties by Province -->
        <div class="max-w-6xl mx-auto px-4 py-12 space-y-10">
            @foreach($provinces as $province)
                <section id="province-{{ Str::slug($province) }}">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-1">{{ $province }}</h2>

                    @php
                        $provinceProperties = $propertiesByState->get($province) ?? collect();
                    @endphp

                    @if($provinceProperties->isEmpty())
                        <p class="text-gray-600 mb-4">No properties listed in {{ $province }} yet.</p>
                    @else
                        <ul class="list-disc list-inside space-y-2">
                            @foreach($provinceProperties as $property)
                                <li>
                                    <a href="{{ route('properties.show', $property->id) }}" class="text-indigo-600 hover:underline">
                                        {{ $property->property_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </section>
            @endforeach
        </div>
    </div>
@endsection
