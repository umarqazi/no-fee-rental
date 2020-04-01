<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = null;
        DB::table('users')->delete();
        if (config('app.env') !== PRODUCTION) {
            $data = [
                [
                    'first_name'        => 'Yousuf',
                    'last_name'         => 'khalid',
                    'email'             => 'yousuf.khalid@admin.com',
                    'user_type'         => ADMIN,
                    'password'          => bcrypt('123456789'),
                    'email_verified_at' => now(),
                    'license_number'    => null,
                    'status'            => ACTIVE,
                    'phone_number'      => '(646) 209-3664',
                    'remember_token'    => str_random(60),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ],
                [
                    'first_name'        => 'Yousuf',
                    'last_name'         => 'khalid',
                    'email'             => 'yousuf.khalid@agent.com',
                    'user_type'         => AGENT,
                    'password'          => bcrypt('123456789'),
                    'email_verified_at' => now(),
                    'status'            => ACTIVE,
                    'phone_number'      => '(646) 209-3664',
                    'license_number'    => '10311204670',
                    'remember_token'    => str_random(60),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ],
                [
                    'first_name'        => 'Yousuf',
                    'last_name'         => 'khalid',
                    'email'             => 'yousuf.khalid@owner.com',
                    'user_type'         => OWNER,
                    'password'          => bcrypt('123456789'),
                    'email_verified_at' => now(),
                    'status'            => ACTIVE,
                    'phone_number'      => '(646) 209-3664',
                    'license_number'    => null,
                    'remember_token'    => str_random(60),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ],
                [
                    'first_name'        => 'Yousuf',
                    'last_name'         => 'khalid',
                    'email'             => 'yousuf.khalid@renter.com',
                    'user_type'         => RENTER,
                    'password'          => bcrypt('123456789'),
                    'email_verified_at' => now(),
                    'status'            => ACTIVE,
                    'phone_number'      => '(646) 209-3664',
                    'license_number'    => null,
                    'remember_token'    => str_random(60),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ],
            ];
        } else {
            $data = [
                // Admin
                [
                    'first_name' => 'Eliyahu',
                    'last_name' => 'Halali',
                    'email' => 'elih@nofeerentalsnyc.com',
                    'user_type' => ADMIN,
                    'password' => bcrypt('123456789'),
                    'email_verified_at' => now(),
                    'phone_number' => '(646) 209-3664',
                    'license_number' => null,
                    'status'            => ACTIVE,
                    'remember_token' => str_random(60),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];
        }

        DB::table('users')->insert($data);
    }
}