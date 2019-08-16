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
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'url' => $faker->url,
        'street_address' => $faker->address,
        'display_address' => $faker->address,
        'map_location' => json_encode(['latitude' => $faker->latitude, 'longitude' => $faker->longitude]),
        'city_state_zip' => $faker->city,
        'square_feet' => random_int(1, 20),
        'description' => $faker->text,
        'rent' => random_int(10, 1000),
        'baths' => random_int(1, 10),
        'bedrooms' => random_int(1, 20),
        'unit' => random_int(1, 200),
        'status' => 'open',
        'visibility' => ACTIVE,
        'available' => $faker->date(),
        'is_featured' => random_int(0, 1),
        'neighborhood' => array_random($neighbours),
        'thumbnail' => $faker->image()
    ];
});
/**
 * Listing Types Faker
 */
$amount = \App\Listing::count();
$values = config('features.listing_features');
$types = array_values(config('features.listing_types'));

$factory->define(\App\ListingTypes::class, function (Faker $faker) use ($amount, $types, $values) {
    $type = array_random($types);
    $features = array_keys($values);
    foreach ($features as $key => $value) {
        if(($key + 1) == $type) {
            $values = array_random(array_keys($values[$value])) + 1;
        }
    }
    return [
        'listing_id' => random_int(1, $amount + 1),
        'property_type' => $type,
        'value' => $values
    ];
});
