<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Features1Seeder;
use Database\Seeders\Properties1Seeder;
use Illuminate\Database\Seeder;
use PropertiesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesAndPermissionsSeeder::class,
            Features1Seeder::class,
            Properties1Seeder::class,
            // Uncomment the following line to seed the default user
            // UserSeeder::class,
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
