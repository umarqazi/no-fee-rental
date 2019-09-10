<?php
return [
	'listing_types' => [
		'listing_type' => 1,
		'pet_policy' => 2,
		'unit_feature' => 3,
		'building_feature' => 4,
		'amenities' => 5,
	],

	'listing_features' => [
		'listing_type' => [
			0 => 'By Owner',
			1 => 'Exclusive',
		],

		'pet_policy' => [
			0 => 'Cats Allowed',
			1 => 'Dogs Allowed',
            2 => 'Pets Allowed'
		],

		'unit_feature' => [
			0 => 'Furnished',
			1 => 'Laundry In Unit',
			2 => 'Parking Space',
			3 => 'Outdoor Space',
		],

		'building_feature' => [
			0 => 'Door Man',
			1 => 'Fitness Centre',
			2 => 'Storage Facility',
			3 => 'Elevator',
		],

		'amenities' => [
			0 => 'Balcony',
			1 => 'Dishwasher',
			2 => 'Concierge',
			3 => 'Elevator',
			4 => 'Furnished',
			5 => 'Gym',
			6 => 'In-Unit Laundry',
			7 => 'On-Site Parking',
			8 => 'Terrace',
		],
	],

	'available' => [
		0 => 'Not Available',
		1 => 'Available',
		2 => 'Immediately',
	],
];
