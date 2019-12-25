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
        DB::table('boroughs')->delete();
        DB::table('neighborhoods')->delete();
        $collection = config('neighborhoods');
        $boro = collect($collection['boro'])->map(function($value, $keys) {
            $boroughs = [
                'boro' => $value,
                'created_at' => now(),
                'updated_at' => now()
            ];

            return $boroughs;
        });

        DB::table('boroughs')->insert($boro->toArray());

        $neighbours = collect($collection['neighborhoods'])->map(function($neighbours, $key) {
            $collection = null;
            foreach ($neighbours as $neighbour) {
                $collection[] = [
                    'name'       => $neighbour,
                    'boro_id'    => $key,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            DB::table('neighborhoods')->insert($collection);
        });
    }
}
