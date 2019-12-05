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
            '2000'   => "$2,000",
            '3000'   => "$3,000",
            '4000'   => "$4,000",
            '5000'   => "$5,000",
            '6000'   => "$6,000",
            '7000'   => "$7,000",
            '8000'   => "$8,000",
            '9000'   => "$9,000",
            '10000'  => "$10,000",
            '11000'  => "$11,000",
            '12000'  => "$12,000",
            '13000'  => "$13,000",
            '14000'  => "$14,000",
            '15000'  => "Up To $15,000",
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
