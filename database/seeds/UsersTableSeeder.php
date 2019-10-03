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
				'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '123456789',
                'license_number' => null,
				'remember_token' => str_random(60),
				'created_at' => now(),
				'updated_at' => now(),
			],
            [
                'first_name' => 'Eli',
                'last_name' => 'Halali',
                'email' => 'nofeerentalsync@admin.com',
                'user_type' => ADMIN,
                'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '123456789',
                'license_number' => null,
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
			[
				'first_name' => 'Muhammad',
				'last_name' => 'Adeel',
				'email' => 'adeel@admin.com',
				'user_type' => ADMIN,
				'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '123456789',
                'license_number' => null,
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
                'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '123456789',
                'license_number' => '40CH1067250',
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Eli',
                'last_name' => 'Halali',
                'email' => 'nofeerentalsync@agent.com',
                'user_type' => AGENT,
                'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '123456789',
                'license_number' => '40CH167250',
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Muhammad',
                'last_name' => 'Adeel',
                'email' => 'adeel@agent.com',
                'user_type' => AGENT,
                'license_number' => '40CH106725',
                'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '123456789',
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Helvin',
                'last_name' => 'Rymer',
                'email' => 'helvin@kwnyc.com',
                'user_type' => AGENT,
                'license_number' => '40CH106732',
                'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '(347) 483-4903',
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Chen',
                'last_name' => 'Mishael',
                'email' => 'cmteam@kwnyc.com',
                'user_type' => AGENT,
                'license_number' => '40CH106742',
                'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '(347) 512-4143',
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jaime',
                'last_name' => 'Farmer',
                'email' => 'jaime@kwnyc.com',
                'user_type' => AGENT,
                'license_number' => '40CH106762',
                'password' => bcrypt('123456789'),
                'email_verified_at' => now(),
                'phone_number' => '(646) 880-0438',
                'remember_token' => str_random(60),
                'created_at' => now(),
                'updated_at' => now(),
            ]
		]);
	}
}
