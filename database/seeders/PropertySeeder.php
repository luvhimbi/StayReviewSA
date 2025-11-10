<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run()
    {
        // List of South African provinces
        $provinces = [
            'Gauteng', 'Western Cape', 'KwaZulu-Natal', 'Eastern Cape',
            'Free State', 'Limpopo', 'Mpumalanga', 'Northern Cape', 'North West'
        ];

        // Sample property types
        $types = ['apartment','house','studio','room'];

        // Sample poster IDs (assuming you have users with these IDs)
        $posterIds = [1, 2];

        for ($i = 1; $i <= 10; $i++) {
            $property = Property::create([
                'poster_id' => $posterIds[array_rand($posterIds)],
                'property_name' => 'Property ' . $i,
                'address' => 'Street ' . rand(1, 100) . ', Suburb ' . rand(1, 20),
                'city' => 'City ' . rand(1, 10),
                'state' => $provinces[array_rand($provinces)],
                'country' => 'South Africa',
                'property_type' => $types[array_rand($types)],
                'main_image' => 'default_property.jpg', // Make sure you have this image in storage
                'approved' => rand(0, 1),
                'verified' => rand(0, 1),
            ]);

            // Add 2-4 additional images per property
            $imageCount = rand(2, 4);
            for ($j = 1; $j <= $imageCount; $j++) {
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_url' => 'default_property_'.$j.'.jpg', // Make sure you have these in storage
                ]);
            }
        }
    }
}
