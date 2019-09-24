<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeighborhoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('neighborhoods')->delete();
        $neigh = config('neighborhoods');
        $array = [];
        foreach ($neigh as $n) {
            $tmp = [
                'name' => $n,
                'created_at' => now(),
                'updated_at' => now()
            ];
            array_push($array, $tmp);
        }
        DB::table('neighborhoods')->insert($array);
        //
    }
}
