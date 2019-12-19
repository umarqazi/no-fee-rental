<?php

use Illuminate\Database\Seeder;
use App\Services\AmenityService;
use Illuminate\Support\Facades\DB;

class AmenitiesTableSeeder extends Seeder {

    /**
     * @var AmenityService
     */
    private $service;

    /**
     * AmenitiesTableSeeder constructor.
     *
     * @param AmenityService $service
     */
    public function __construct(AmenityService $service) {
        $this->service = $service;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $batch = [];
        DB::table('amenities')->delete();
        $amenities = config('features.building_features');
        foreach ($amenities as $amenity) {
            $collect = [
                'amenities'       => $amenity,
                'created_at'      => now(),
                'updated_at'      => now(),
            ];

            array_push($batch, $collect);
        }

            $this->service->insert($batch);
    }
}
