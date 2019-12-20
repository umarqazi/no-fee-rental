<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeighborhoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('neighborhoods')->delete();
        $neighbours = collect(config('neighborhoods'))->map(function($neighbour) {
            $collection = [
                'name' => $neighbour,
                'boro_id' => random_int(1, 5),
                'created_at' => now(),
                'updated_at' => now()
            ];

            return $collection;
        });

        DB::table('neighborhoods')->insert($neighbours->toArray());
    }
}
