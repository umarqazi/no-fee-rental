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
        DB::table('amenities')->delete();
        DB::table('amenity_types')->delete();
        $amenities = config('amenities');
        collect($amenities)->map(function($amenities, $amenity_type) {
            $batch = [];
            $amenity_type =  $this->service->createType(
                [
                    'amenity_type' => ucwords(str_replace('_', ' ', $amenity_type))
                ]);

            foreach ($amenities as $amenity) {
                $collect = [
                    'amenity_type_id' => $amenity_type->id,
                    'amenities'       => $amenity,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ];

                array_push($batch, $collect);
            }

            $this->service->insert($batch);
        });
    }
}
