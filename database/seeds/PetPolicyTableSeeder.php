<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

/**
 * Class PetPolicyTableSeeder
 */
class PetPolicyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pet_policies')->delete();

        $collection = [];
        $pets = config('features.pet_policy');

        foreach ($pets as $key => $pet) {
            if($key === 'title') continue;
            $array = [
                'name' => $pet,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            array_push($collection, $array);
        }

        DB::table('pet_policies')->insert($collection);
    }
}
