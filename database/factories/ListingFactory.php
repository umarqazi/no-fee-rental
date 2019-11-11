<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/**
 * Listing Faker
 */
$neighbours = config('neighborhoods');
$factory->define(\App\Listing::class, function (Faker $faker) use ($neighbours) {
    return [
        'name' => $faker->name,
        'user_id' => random_int(1, 6),
        'unique_slug' => str_random(20),
        'realty_id' => random_int(1, 6),
        'realty_url' => $faker->email,
        'neighborhood_id' => random_int(1, 6),
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'street_address' => $faker->address,
        'display_address' => $faker->address,
        'map_location' => json_encode(['latitude' => $faker->latitude, 'longitude' => $faker->longitude]),
        'square_feet' => random_int(1, 20),
        'description' => $faker->text,
        'rent' => random_int(10, 1000),
        'baths' => random_int(1, 10),
        'bedrooms' => random_int(1, 20),
        'unit' => random_int(1, 200),
        'visibility' => ACTIVE,
        'availability' => '2019-11-11 07:39:03',
        'is_featured' => random_int(0, 1),
        'thumbnail' => $faker->image()
    ];
});
