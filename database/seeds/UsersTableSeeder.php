<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('users')->delete();
		DB::table('users')->insert([
			[
				'first_name' => 'Yousuf',
				'last_name' => 'Khalid',
				'email' => 'codinghackers@gmail.com',
				'user_type' => 1,
				'password' => bcrypt('123456'),
				'remember_token' => str_random(60),
				'created_at' => now(),
				'updated_at' => now(),
			],
			[
				'first_name' => 'Muhammad',
				'last_name' => 'Addel',
				'email' => 'adeel@gems.techverx.com',
				'user_type' => 1,
				'password' => bcrypt('123456'),
				'remember_token' => str_random(60),
				'created_at' => now(),
				'updated_at' => now(),
			],
		]);
	}
}
