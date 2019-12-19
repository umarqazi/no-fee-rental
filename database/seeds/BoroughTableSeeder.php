<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoroughTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boroughs')->delete();
        DB::table('boroughs')->insert([
            [
                'boro' => 'Manhattan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'boro' => 'Bronx',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'boro' => 'Brooklyn',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'boro' => 'Queens',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'boro' => 'Staten Island',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
