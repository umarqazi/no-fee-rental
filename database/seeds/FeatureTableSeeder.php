<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

/**
 * Class ListingFeatureTableSeeder
 */
class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->delete();

        $collection = [];
        $pets = config('features.apartment_features');

        foreach ($pets as $key => $pet) {
            if($key === 'title') continue;
            $array = [
                'name' => $pet,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            array_push($collection, $array);
        }

        DB::table('features')->insert($collection);
    }
}
