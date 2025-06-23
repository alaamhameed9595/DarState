<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Features1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            'Swimming Pool',
            'Garage',
            'Garden',
            'Fireplace',
            'Air Conditioning',
            'Balcony',
            'Gym',
            'Security System',
        ];

        foreach ($features as $feature) {
            Feature::firstOrCreate(['name' => $feature]);
        }
    }
}
