<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('roles')->delete();

		DB::table('roles')->insert([
			[
				'name' => 'Admin',
				'guard_name' => 'web',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Agent',
				'guard_name' => 'web',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Owner',
				'guard_name' => 'web',
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'name' => 'Renter',
				'guard_name' => 'web',
				'created_at' => now(),
				'updated_at' => now(),
			],

		]);
	}
}
