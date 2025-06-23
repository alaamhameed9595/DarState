<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Properties1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'title' => 'Luxury Villa',
                'description' => 'A beautiful villa with modern amenities.',
                'price' => 500000,
                'address' => '123 Palm Street',
                'city' => 'Palm City',
                'country' => 'Palm City',
                'state' => 'California',
                'zipcode' => '90001',
                'bedrooms' => 5,
                'bathrooms' => 4,
                'size' => 3500,
                'type' => 'house',
                'agent_id' => 1, // Make sure this agent exists
                'process_type' => 0,
                'year_built' => 2018,
                'latitude' => 34.0522,
                'longitude' => -118.2437,
            ],
            [
                'title' => 'Downtown Apartment',
                'description' => 'Apartment in the heart of the city.',
                'price' => 250000,
                'address' => '456 City Ave',
                'city' => 'Metro City',
                'country' => 'Palm City',
                'state' => 'New York',
                'zipcode' => '10001',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'process_type' => 1,
                'size' => 1200,
                'type' => 'apartment',
                'agent_id' => 1,

                'year_built' => 2020,
                'latitude' => 40.7128,
                'longitude' => -74.0060,
            ],
            [
                'title' => 'Cozy Cottage',
                'description' => 'A charming cottage in the countryside.',
                'price' => 150000,
                'address' => '789 Country Rd',
                'city' => 'Countryside',
                'country' => 'uae',
                'state' => 'Texas',
                'zipcode' => '73301',
                'bedrooms' => 3,
                'process_type' => 0,
                'bathrooms' => 2,
                'size' => 1800,
                'type' => 'land',
                'agent_id' => 1,

                'year_built' => 2015,
                'latitude' => 30.2672,
                'longitude' => -97.7431,
            ],
        ];


        foreach ($properties as $data) {
            $property = Property::create($data);

            // Attach random features
            $featureIds = Feature::inRandomOrder()->take(rand(2, 4))->pluck('id');
            $property->features()->attach($featureIds);
        }
    }
}
