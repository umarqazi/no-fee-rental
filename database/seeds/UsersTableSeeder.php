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
		    // Admins
			[
				'first_name' => 'Eliyahu',
				'last_name'  => 'Halali',
				'email'      => 'elih@nofeerentalsnyc.com',
				'user_type'  => ADMIN,
				'password'   => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number'   => '(646) 209-3664',
                'license_number' => '10311204670',
				'remember_token' => str_random(60),
				'created_at' => now(),
				'updated_at' => now(),
			],
		]);
	}
}
