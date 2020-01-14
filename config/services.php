<?php

return [

	/*
		    |--------------------------------------------------------------------------
		    | Third Party Services
		    |--------------------------------------------------------------------------
		    |
		    | This file is for storing the credentials for third party services such
		    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
		    | default location for this type of information, allowing packages
		    | to have a conventional place to find your various credentials.
		    |
	*/

	'google' => [
		'map_api' => env('GOOGLE_MAP_API', 'AIzaSyAXbbZYutEBE_0ulFJVMlgOprFErdXmJvg'),
	],

	'mailgun' => [
		'domain' => env('MAILGUN_DOMAIN'),
		'secret' => env('MAILGUN_SECRET'),
		'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
	],

	'ses' => [
		'key' => env('SES_KEY'),
		'secret' => env('SES_SECRET'),
		'region' => env('SES_REGION', 'us-east-1'),
	],

	'sparkpost' => [
		'secret' => env('SPARKPOST_SECRET'),
	],

	'stripe' => [
		'model' => App\User::class,
		'key' => 'pk_test_RQ2fPorp6qFFAW1NvGJobeBh00m1XS5rpm',
		'secret' => 'sk_test_PtFSw7Appm0peeJ7FgMChNvy00CccbffjO',
		'webhook' => [
			'secret' => env('STRIPE_WEBHOOK_SECRET'),
			'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
		],
	],

];
