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

    'search' => [
        'price' => [
            ''       => 'Price',
            '2000'   => "Up To $2,000",
            '2500'   => "$2,500",
            '3000'   => "$3,000",
            '3500'   => "$3,500",
            '4000'   => "$4,000",
            '4500'   => "$4,500",
            '5000'   => "$5,000",
            '5500'   => "$5,500",
            '6000'   => "$6,000",
            '6500'   => "$6,500",
            '7000'   => "$7,000",
            '7500'   => "$7,500",
            '8000'   => "$8,000",
            '8500'   => "$8,500",
            '9000'   => "$9,000",
            '9500'   => "$9,500",
            '10000'  => "$10,000",
        ],

        'beds' => [
            ''        => 'Beds',
            'studio'  => 'studio',
            '1'       => '1',
            '2'       => '2',
            '3'       => '3',
            '4'       => '4',
            '5'       => '5+'
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
