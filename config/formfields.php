<?php

return [
    'listing' => [
        'availability' => [
            1 => 'Immediately',
            3 => 'By Date Only',
            4 => 'Not Available',
        ]
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
            '' => 'Beds',
            '1'  => '1',
            '2'  => '2',
            '3'  => '3',
            '4'  => '4',
            '5'  => '5+'
        ]
    ],

    'building_action' => [
        ''         => 'Select Building Action',
        ALLOWAGENT => 'Allow Agent',
        OWNERONLY  => 'Owner Only'
    ]
];
