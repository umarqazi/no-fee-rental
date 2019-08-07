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
				'first_name' => 'Yousuf',
				'last_name' => 'Khalid',
				'email' => 'codinghackers@admin.com',
				'user_type' => ADMIN,
				'status' => 1,
				'password' => bcrypt('123456789'),
				'remember_token' => str_random(60),
				'created_at' => now(),
				'updated_at' => now(),
			],
            [
                'first_name' => 'Eli',
                'last_name' => 'Halali',
                'email' => 'nofeerentalsync@admin.com',
                'user_type' => ADMIN,
                'status' => 1,
                'password' => bcrypt('123456789'),
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
			[
				'first_name' => 'Muhammad',
				'last_name' => 'Adeel',
				'email' => 'adeel@admin.com',
				'user_type' => ADMIN,
				'status' => 1,
				'password' => bcrypt('123456789'),
				'remember_token' => str_random(60),
				'created_at' => now(),
				'updated_at' => now(),
			],
            // Agents
            [
                'first_name' => 'Yousuf',
                'last_name' => 'Khalid',
                'email' => 'codinghackers@agent.com',
                'user_type' => AGENT,
                'status' => 1,
                'password' => bcrypt('123456789'),
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Eli',
                'last_name' => 'Halali',
                'email' => 'nofeerentalsync@agent.com',
                'user_type' => AGENT,
                'status' => 1,
                'password' => bcrypt('123456789'),
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Muhammad',
                'last_name' => 'Adeel',
                'email' => 'adeel@agent.com',
                'user_type' => AGENT,
                'status' => 1,
                'password' => bcrypt('123456789'),
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
		]);
	}
}
