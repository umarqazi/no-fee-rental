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
        $amenities = [
            0  => 'Balcony',
            1  => 'Dishwasher',
            2  => 'Concierge',
            3  => 'Elevator',
            4  => 'Furnished',
            5  => 'Gym',
            6  => 'In-Unit Laundry',
            7  => 'On-Site Parking',
            8  => 'Terrace',
            9  => 'Door Man',
            10 => 'Fitness Centre',
            11 => 'Storage Facility',
            12 => 'Elevator',
        ];
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
