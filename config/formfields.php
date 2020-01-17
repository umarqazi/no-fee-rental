<?php

return [
    'listing' => [

        'availability' => [
            1 => 'Immediately',
            2 => 'By Date Only',
            0 => 'Not Available',
        ],

        'free_months' => [
            "" => "Select Lease Term",
            '1 Month'   => "1 Month",
            '2 Months'  => "2 Months",
            '3 Months'  => "3 Months",
            '4 Months'  => "4 Months",
            '5 Months'  => "5 Months",
            '6 Months'  => "6 Months",
            '7 Months'  => "7 Months",
            '8 Months'  => "8 Months",
            '9 Months'  => "9 Months",
            '10 Months' => "10 Months",
            '11 Months' => "11 Months",
            '12 Months' => "12 Months",
            '13 Months' => "13 Months",
            '14 Months' => "14 Months",
            '15 Months' => "15 Months",
            '16 Months' => "16 Months",
            '17 Months' => "17 Months",
            '18 Months' => "18 Months",
            '19 Months' => "19 Months",
            '20 Months' => "20 Months",
            '21 Months' => "21 Months",
            '22 Months' => "22 Months",
            '23 Months' => "23 Months",
            '24 Months' => "24 Months"
        ],

        'beds' => [
            ''        => 'Select Beds',
            '0.5'     => 'Studio',
            '1'       => '1',
            '2'       => '2',
            '3'       => '3',
            '4'       => '4',
            '5'       => '5+'
        ],

        'baths' => [
            ''        => 'Select Baths',
            '1'       => '1',
            '2'       => '2',
            '3'       => '3',
            '4'       => '4',
            '5'       => '5+'
        ],

        'listing_report_reasons' => [
            "" => "Select Reason",
            1 => "This listing is no longer available.",
            2 => "This is a fraudulent listing.",
            3 => "This listing has incorrect information/photos.",
            4 => "This is a discriminatory or offensive listing.",
        ],

        'listing_type' => [
            ''          => 'Select Type',
            'open'      => 'Open',
            'exclusive' => 'Exclusive'
        ]
    ],

    'boro' => [
        NULL         => 'Select Borough',
        MANHATTAN    => 'Manhattan',
        BROOKLYN     => 'Brooklyn',
        QUEENS       => 'Queens',
        BRONX        => 'Bronx',
        STATENISLAND => 'Staten Island',
        OTHER        => 'Other'
    ],

    'user' => [
        'roles' => [
            '' => 'Select Type',
            AGENT  => 'Agent',
            OWNER  => 'Owner',
            RENTER => 'Renter'
        ]
    ],

    'sorting' => [
        'cheaper' => 'Cheapest',
        'recent'  => 'Recent',
        'older'   => 'Oldest',
    ],

    'building_action' => [
        ''         => 'Select Building Action',
        ALLOWAGENT => 'Allow Agent',
        OWNERONLY  => 'Owner Only'
    ]
];
