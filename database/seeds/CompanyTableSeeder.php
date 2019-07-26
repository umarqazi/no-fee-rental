<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('companies')->delete();

		DB::table('companies')->insert([
			[
				'company' => 'Techverx',
				'status' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'company' => 'Netsol',
				'status' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'company' => 'Systems Limited',
				'status' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'company' => 'Tech Nerds',
				'status' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'company' => 'Unicorn Sol',
				'status' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'company' => 'Aktech Zone',
				'status' => true,
				'created_at' => now(),
				'updated_at' => now(),
			],
		]);
	}
}
