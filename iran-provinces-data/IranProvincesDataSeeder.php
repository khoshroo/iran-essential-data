<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IranProvincesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the JSON file content
        $jsonPath = database_path('seeders/data/iran-provinces-and-cities.json');
        $jsonContent = json_decode(file_get_contents($jsonPath), true);

        // Begin transaction
        DB::beginTransaction();

        try {
            // Insert provinces
            foreach ($jsonContent['provinces'] as $province) {
                DB::table('provinces')->insert([
                    'id' => $province['id'],
                    'name' => $province['name'],
                    'postal_code' => $province['postal_code'],
                    'lat' => $province['lat'],
                    'long' => $province['long'],
                    'zoom_level' => $province['zoom_level'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Insert cities
            foreach ($jsonContent['cities'] as $city) {
                DB::table('cities')->insert([
                    'name' => $city['name'],
                    'postalcode' => $city['postal_code'],
                    'province_id' => $city['province_id'],
                    'lat' => $city['lat'],
                    'long' => $city['long'],
                    'size' => $city['size'],
                    'zoom_level' => $city['zoom_level'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Commit transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollback();
            throw $e;
        }
    }
}
