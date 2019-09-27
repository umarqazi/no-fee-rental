<?php return array (
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://no-fee-rental.teamtechverx.com/',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:XqJnbI4NjFVNdAKKr4JOpf93TqgklEszLfvheWw4wb8=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Collective\\Html\\HtmlServiceProvider',
      23 => 'Yajra\\DataTables\\DataTablesServiceProvider',
      24 => 'MaddHatter\\LaravelFullcalendar\\ServiceProvider',
      25 => 'App\\Providers\\AppServiceProvider',
      26 => 'App\\Providers\\AuthServiceProvider',
      27 => 'App\\Providers\\BroadcastServiceProvider',
      28 => 'App\\Providers\\EventServiceProvider',
      29 => 'App\\Providers\\RouteServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Form' => 'Collective\\Html\\FormFacade',
      'HTML' => 'Collective\\Html\\HtmlFacade',
      'DataTables' => 'Yajra\\DataTables\\Facades\\DataTables',
      'Calendar' => 'MaddHatter\\LaravelFullcalendar\\Facades\\Calendar',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
      ),
      'admin' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'agent' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'encrypted' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home/deployer/no-fee-rental/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'no_fee_rental',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'no_fee_rental',
        'username' => 'root',
        'password' => 'gQx!)vv523~',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'no_fee_rental',
        'username' => 'root',
        'password' => 'gQx!)vv523~',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'no_fee_rental',
        'username' => 'root',
        'password' => 'gQx!)vv523~',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'default' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => '%s %s NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'features' => 
  array (
    'listing_types' => 
    array (
      'listing_type' => 1,
      'pet_policy' => 2,
      'unit_feature' => 3,
      'building_feature' => 4,
      'amenities' => 5,
    ),
    'listing_features' => 
    array (
      'listing_type' => 
      array (
        0 => 'Open',
        1 => 'Exclusive',
      ),
      'pet_policy' => 
      array (
        0 => 'Cats Allowed',
        1 => 'Dogs Allowed',
        2 => 'Pets Allowed',
        3 => 'Pets Not Allowed',
      ),
      'amenities' => 
      array (
        0 => 'Balcony',
        1 => 'Dishwasher',
        2 => 'Concierge',
        3 => 'Elevator',
        4 => 'Furnished',
        5 => 'Gym',
        6 => 'In-Unit Laundry',
        7 => 'On-Site Parking',
        8 => 'Terrace',
        9 => 'Door Man',
        10 => 'Fitness Centre',
        11 => 'Storage Facility',
        12 => 'Elevator',
      ),
      'unit_feature' => 
      array (
        0 => 'Furnished',
        1 => 'Laundry In Unit',
        2 => 'Parking Space',
        3 => 'Outdoor Space',
      ),
    ),
    'available' => 
    array (
      0 => 'Not Available',
      1 => 'Available',
      2 => 'Immediately',
      3 => 'By Specific Date',
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home/deployer/no-fee-rental/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home/deployer/no-fee-rental/storage/app/public',
        'url' => 'http://no-fee-rental.teamtechverx.com//storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => 'ecs-staging',
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'languages' => 
  array (
    0 => 'English',
    1 => 'Dutch',
    2 => 'Urdu',
    3 => 'Arabic',
    4 => 'Hindi',
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home/deployer/no-fee-rental/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home/deployer/no-fee-rental/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.gmail.com',
    'port' => '587',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => 'tls',
    'username' => 'muhammad.adeel@gems.techverx.com',
    'password' => 'kammalik3256789',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home/deployer/no-fee-rental/resources/views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'neighborhoods' => 
  array (
    0 => 'Melrose',
    1 => 'Mott Haven',
    2 => 'Port Morris',
    3 => 'Hunts Point',
    4 => 'Longwood',
    5 => 'Claremont',
    6 => 'Concourse Village',
    7 => 'Crotona Park',
    8 => 'Morrisania',
    9 => 'Concourse',
    10 => 'High Bridge',
    11 => 'Fordham',
    12 => 'Morris Heights',
    13 => 'Mount Hope',
    14 => 'University Heights',
    15 => 'Bathgate',
    16 => 'Belmont',
    17 => 'East Tremont',
    18 => 'West Farms',
    19 => 'Bedford Park',
    20 => 'Norwood',
    21 => 'University Heights',
    22 => 'Fieldston',
    23 => 'Kingsbridge',
    24 => 'Kingsbridge Heights',
    25 => 'Marble Hill',
    26 => 'Riverdale',
    27 => 'Spuyten Duyvil',
    28 => 'Van Cortlandt Village',
    29 => 'Bronx River',
    30 => 'Bruckner',
    31 => 'Castle Hill',
    32 => 'Clason Point',
    33 => 'Harding Park',
    34 => 'Parkchester',
    35 => 'Soundview',
    36 => 'Unionport',
    37 => 'City Island',
    38 => 'Co-op City',
    39 => 'Locust Point',
    40 => 'Pelham Bay',
    41 => 'Silver Beach',
    42 => 'Throgs Neck',
    43 => 'Westchester Square',
    44 => 'Allerton',
    45 => 'Bronxdale',
    46 => 'Indian Village',
    47 => 'Laconia',
    48 => 'Morris Park',
    49 => 'Pelham Gardens',
    50 => 'Pelham Parkway',
    51 => 'Van Nest',
    52 => 'Baychester',
    53 => 'Edenwald',
    54 => 'Eastchester',
    55 => 'Fish Bay',
    56 => 'Olinville',
    57 => 'Wakefield',
    58 => 'Williamsbridge',
    59 => 'Woodlawn',
    60 => 'Greenpoint',
    61 => 'Williamsburg',
    62 => 'Boerum Hill',
    63 => 'Brooklyn Heights',
    64 => 'Brooklyn Navy Yard',
    65 => 'Clinton Hill',
    66 => 'DUMBO',
    67 => 'Fort Greene',
    68 => 'Fulton Ferry',
    69 => 'Fulton Mall',
    70 => 'Vinegar Hill',
    71 => 'Bedford-Stuyvesant',
    72 => 'Ocean Hill',
    73 => 'Stuyvesant Heights',
    74 => 'Bushwick',
    75 => 'City Line',
    76 => 'Cypress Hills',
    77 => 'East New York',
    78 => 'Highland Park',
    79 => 'New Lots',
    80 => 'Starrett City',
    81 => 'Carroll Gardens',
    82 => 'Cobble Hill',
    83 => 'Gowanus',
    84 => 'Park Slope',
    85 => 'Red Hook',
    86 => 'Greenwood Heights',
    87 => 'Sunset Park',
    88 => 'Windsor Terrace',
    89 => 'Crown Heights',
    90 => 'Prospect Heights',
    91 => 'Weeksville',
    92 => 'Crown Heights',
    93 => 'Prospect Lefferts Gardens',
    94 => 'Wingate',
    95 => 'Bay Ridge',
    96 => 'Dyker Heights',
    97 => 'Fort Hamilton',
    98 => 'Bath Beach',
    99 => 'Bensonhurst',
    100 => 'Gravesend',
    101 => 'Mapleton',
    102 => 'Borough Park',
    103 => 'Kensington',
    104 => 'Midwood',
    105 => 'Ocean Parkway',
    106 => 'Bensonhurst',
    107 => 'Brighton Beach',
    108 => 'Coney Island',
    109 => 'Gravesend',
    110 => 'Sea Gate',
    111 => 'Flatbush',
    112 => 'Kensington',
    113 => 'Midwood',
    114 => 'Ocean Parkway',
    115 => 'East Gravesend',
    116 => 'Gerritsen Beach',
    117 => 'Homecrest',
    118 => 'Kings Bay',
    119 => 'Kings Highway',
    120 => 'Madison',
    121 => 'Manhattan Beach',
    122 => 'Plum Beach',
    123 => 'Sheepshead Bay',
    124 => 'Brownsville',
    125 => 'Ocean Hill',
    126 => 'Ditmas Village',
    127 => 'East Flatbush',
    128 => 'Erasmus',
    129 => 'Farragut',
    130 => 'Remsen Village',
    131 => 'Rugby',
    132 => 'Bergen Beach',
    133 => 'Canarsie',
    134 => 'Flatlands',
    135 => 'Georgetown',
    136 => 'Marine Park',
    137 => 'Mill Basin',
    138 => 'Mill Island',
    139 => 'Battery Park City',
    140 => 'Financial District',
    141 => 'TriBeCa',
    142 => 'Chinatown',
    143 => 'Greenwich Village',
    144 => 'Little Italy',
    145 => 'Lower East Side',
    146 => 'NoHo',
    147 => 'SoHo',
    148 => 'West Village',
    149 => 'Alphabet City',
    150 => 'Chinatown',
    151 => 'East Village',
    152 => 'Lower East Side',
    153 => 'Two Bridges',
    154 => 'Chelsea',
    155 => 'Clinton',
    156 => 'Midtown',
    157 => 'Gramercy Park',
    158 => 'Kips Bay',
    159 => 'Rose Hill',
    160 => 'Murray Hill',
    161 => 'Peter Cooper Village',
    162 => 'Stuyvesant Town',
    163 => 'Sutton Place',
    164 => 'Tudor City',
    165 => 'Turtle Bay',
    166 => 'Waterside Plaza',
    167 => 'Lincoln Square',
    168 => 'Manhattan Valley',
    169 => 'Upper West Side',
    170 => 'Lenox Hill',
    171 => 'Roosevelt Island',
    172 => 'Upper East Side',
    173 => 'Yorkville',
    174 => 'Hamilton Heights',
    175 => 'Manhattanville',
    176 => 'Morningside Heights',
    177 => 'Harlem',
    178 => 'Polo Grounds',
    179 => 'East Harlem',
    180 => 'Randall’s Island',
    181 => 'Spanish Harlem',
    182 => 'Wards Island',
    183 => 'Inwood',
    184 => 'Washington Heights',
    185 => 'Astoria',
    186 => 'Ditmars',
    187 => 'Garden Bay',
    188 => 'Long Island City',
    189 => 'Old Astoria',
    190 => 'Queensbridge',
    191 => 'Ravenswood',
    192 => 'Steinway',
    193 => 'Woodside',
    194 => 'Hunters Point',
    195 => 'Long Island City',
    196 => 'Sunnyside',
    197 => 'Woodside',
    198 => 'East Elmhurst',
    199 => 'Jackson Heights',
    200 => 'North Corona',
    201 => 'Corona',
    202 => 'Elmhurst',
    203 => 'Fresh Pond',
    204 => 'Glendale',
    205 => 'Maspeth',
    206 => 'Middle Village',
    207 => 'Liberty Park',
    208 => 'Ridgewood',
    209 => 'Forest Hills',
    210 => 'Rego Park',
    211 => 'Bay Terrace',
    212 => 'Beechhurst',
    213 => 'College Point',
    214 => 'Flushing',
    215 => 'Linden Hill',
    216 => 'Malba',
    217 => 'Queensboro Hill',
    218 => 'Whitestone',
    219 => 'Willets Point',
    220 => 'Briarwood',
    221 => 'Cunningham Heights',
    222 => 'Flushing South',
    223 => 'Fresh Meadows',
    224 => 'Hilltop Village',
    225 => 'Holliswood',
    226 => 'Jamaica Estates',
    227 => 'Kew Gardens Hills',
    228 => 'Pomonok Houses',
    229 => 'Utopia',
    230 => 'Kew Gardens',
    231 => 'Ozone Park',
    232 => 'Richmond Hill',
    233 => 'Woodhaven',
    234 => 'Howard Beach',
    235 => 'Lindenwood',
    236 => 'Richmond Hill',
    237 => 'South Ozone Park',
    238 => 'Tudor Village',
    239 => 'Auburndale',
    240 => 'Bayside',
    241 => 'Douglaston',
    242 => 'East Flushing',
    243 => 'Hollis Hills',
    244 => 'Little Neck',
    245 => 'Oakland Gardens',
    246 => 'Baisley Park',
    247 => 'Jamaica',
    248 => 'Hollis',
    249 => 'Rochdale Village',
    250 => 'St. Albans',
    251 => 'South Jamaica',
    252 => 'Springfield Gardens',
    253 => 'Bellerose',
    254 => 'Brookville',
    255 => 'Cambria Heights',
    256 => 'Floral Park',
    257 => 'Glen Oaks',
    258 => 'Laurelton',
    259 => 'Meadowmere',
    260 => 'New Hyde Park',
    261 => 'Queens Village',
    262 => 'Rosedale',
    263 => 'Arverne',
    264 => 'Bayswater',
    265 => 'Belle Harbor',
    266 => 'Breezy Point',
    267 => 'Edgemere',
    268 => 'Far Rockaway',
    269 => 'Neponsit',
    270 => 'Rockaway Park',
    271 => 'Arlington',
    272 => 'Castleton Corners',
    273 => 'Clifton',
    274 => 'Concord',
    275 => 'Elm Park',
    276 => 'Fort Wadsworth',
    277 => 'Graniteville',
    278 => 'Grymes Hill',
    279 => 'Livingston',
    280 => 'Mariners Harbor',
    281 => 'Meiers Corners',
    282 => 'New Brighton',
    283 => 'Port Ivory',
    284 => 'Port Richmond',
    285 => 'Randall Manor',
    286 => 'Rosebank',
    287 => 'St. George',
    288 => 'Shore Acres',
    289 => 'Silver Lake',
    290 => 'Stapleton',
    291 => 'Sunnyside',
    292 => 'Tompkinsville',
    293 => 'West Brighton',
    294 => 'Westerleigh',
    295 => 'Arrochar',
    296 => 'Bloomfield',
    297 => 'Bulls Head',
    298 => 'Chelsea',
    299 => 'Dongan Hills',
    300 => 'Egbertville',
    301 => 'Emerson Hill',
    302 => 'Grant City',
    303 => 'Grasmere',
    304 => 'Midland Beach',
    305 => 'New Dorp',
    306 => 'New Springville',
    307 => 'Oakwood',
    308 => 'Ocean Breeze',
    309 => 'Old Town',
    310 => 'South Beach',
    311 => 'Todt Hill',
    312 => 'Travis',
    313 => 'Annadale',
    314 => 'Arden Heights',
    315 => 'Bay Terrace',
    316 => 'Charleston',
    317 => 'Eltingville',
    318 => 'Great Kills',
    319 => 'Greenridge',
    320 => 'Huguenot',
    321 => 'Pleasant Plains',
    322 => 'Prince’s Bay',
    323 => 'Richmond Valley',
    324 => 'Rossville',
    325 => 'Tottenville',
    326 => 'Woodrow',
  ),
  'newsletter' => 
  array (
    'apiKey' => 'd140b88234ac0ca14567286c3a62d2d7-us3',
    'defaultListName' => 'subscribers',
    'lists' => 
    array (
      'subscribers' => 
      array (
        'id' => '51938a6f62',
      ),
    ),
    'ssl' => true,
  ),
  'openHouse' => 
  array (
    0 => 'Select Time',
    1 => '8:00 am',
    2 => '8:15 am',
    3 => '8:30 am',
    4 => '8:45 am',
    5 => '9:00 am',
    6 => '9:15 am',
    7 => '9:30 am',
    8 => '9:45 am',
    9 => '10:00 am',
    10 => '10:15 am',
    11 => '10:30 am',
    12 => '10:45 am',
    13 => '11:00 am',
    14 => '11:15 am',
    15 => '11:30 am',
    16 => '11:45 am',
    17 => '12:00 pm',
    18 => '12:15 pm',
    19 => '12:30 pm',
    20 => '12:45 pm',
    21 => '1:00 pm',
    22 => '1:15 pm',
    23 => '1:30 pm',
    24 => '1:45 pm',
    25 => '2:00 pm',
    26 => '2:15 pm',
    27 => '2:30 pm',
    28 => '2:45 pm',
    29 => '3:00 pm',
    30 => '3:15 pm',
    31 => '3:30 pm',
    32 => '3:45 pm',
    33 => '4:00 pm',
    34 => '4:15 pm',
    35 => '4:30 pm',
    36 => '4:45 pm',
    37 => '5:00 pm',
    38 => '5:15 pm',
    39 => '5:30 pm',
    40 => '5:45 pm',
    41 => '6:00 pm',
    42 => '6:15 pm',
    43 => '6:30 pm',
    44 => '6:45 pm',
    45 => '7:00 pm',
    46 => '7:15 pm',
    47 => '7:30 pm',
    48 => '7:45 pm',
    49 => '8:00 pm',
    50 => '8:15 pm',
    51 => '8:30 pm',
    52 => '8:45 pm',
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'google' => 
    array (
      'map_api' => 'AIzaSyAXbbZYutEBE_0ulFJVMlgOprFErdXmJvg',
    ),
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'sparkpost' => 
    array (
      'secret' => NULL,
    ),
    'stripe' => 
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
      'webhook' => 
      array (
        'secret' => NULL,
        'tolerance' => 300,
      ),
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/deployer/no-fee-rental/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home/deployer/no-fee-rental/resources/views',
    ),
    'compiled' => '/home/deployer/no-fee-rental/storage/framework/views',
  ),
  'debug-server' => 
  array (
    'host' => 'tcp://127.0.0.1:9912',
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'excel' => 
  array (
    'cache' => 
    array (
      'enable' => true,
      'driver' => 'memory',
      'settings' => 
      array (
        'memoryCacheSize' => '32MB',
        'cacheTime' => 600,
      ),
      'memcache' => 
      array (
        'host' => 'localhost',
        'port' => 11211,
      ),
      'dir' => '/home/deployer/no-fee-rental/storage/cache',
    ),
    'properties' => 
    array (
      'creator' => 'Maatwebsite',
      'lastModifiedBy' => 'Maatwebsite',
      'title' => 'Spreadsheet',
      'description' => 'Default spreadsheet export',
      'subject' => 'Spreadsheet export',
      'keywords' => 'maatwebsite, excel, export',
      'category' => 'Excel',
      'manager' => 'Maatwebsite',
      'company' => 'Maatwebsite',
    ),
    'sheets' => 
    array (
      'pageSetup' => 
      array (
        'orientation' => 'portrait',
        'paperSize' => '9',
        'scale' => '100',
        'fitToPage' => false,
        'fitToHeight' => true,
        'fitToWidth' => true,
        'columnsToRepeatAtLeft' => 
        array (
          0 => '',
          1 => '',
        ),
        'rowsToRepeatAtTop' => 
        array (
          0 => 0,
          1 => 0,
        ),
        'horizontalCentered' => false,
        'verticalCentered' => false,
        'printArea' => NULL,
        'firstPageNumber' => NULL,
      ),
    ),
    'creator' => 'Maatwebsite',
    'csv' => 
    array (
      'delimiter' => ',',
      'enclosure' => '"',
      'line_ending' => '
',
      'use_bom' => false,
    ),
    'export' => 
    array (
      'autosize' => true,
      'autosize-method' => 'approx',
      'generate_heading_by_indices' => true,
      'merged_cell_alignment' => 'left',
      'calculate' => false,
      'includeCharts' => false,
      'sheets' => 
      array (
        'page_margin' => false,
        'nullValue' => NULL,
        'startCell' => 'A1',
        'strictNullComparison' => false,
      ),
      'store' => 
      array (
        'path' => '/home/deployer/no-fee-rental/storage/exports',
        'returnInfo' => false,
      ),
      'pdf' => 
      array (
        'driver' => 'DomPDF',
        'drivers' => 
        array (
          'DomPDF' => 
          array (
            'path' => '/home/deployer/no-fee-rental/vendor/dompdf/dompdf/',
          ),
          'tcPDF' => 
          array (
            'path' => '/home/deployer/no-fee-rental/vendor/tecnick.com/tcpdf/',
          ),
          'mPDF' => 
          array (
            'path' => '/home/deployer/no-fee-rental/vendor/mpdf/mpdf/',
          ),
        ),
      ),
    ),
    'filters' => 
    array (
      'registered' => 
      array (
        'chunk' => 'Maatwebsite\\Excel\\Filters\\ChunkReadFilter',
      ),
      'enabled' => 
      array (
      ),
    ),
    'import' => 
    array (
      'heading' => 'slugged',
      'startRow' => 1,
      'separator' => '_',
      'slug_whitelist' => '._',
      'includeCharts' => false,
      'to_ascii' => true,
      'encoding' => 
      array (
        'input' => 'UTF-8',
        'output' => 'UTF-8',
      ),
      'calculate' => true,
      'ignoreEmpty' => false,
      'force_sheets_collection' => false,
      'dates' => 
      array (
        'enabled' => true,
        'format' => false,
        'columns' => 
        array (
        ),
      ),
      'sheets' => 
      array (
        'test' => 
        array (
          'firstname' => 'A2',
        ),
      ),
    ),
    'views' => 
    array (
      'styles' => 
      array (
        'th' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'strong' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'b' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'i' => 
        array (
          'font' => 
          array (
            'italic' => true,
            'size' => 12,
          ),
        ),
        'h1' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 24,
          ),
        ),
        'h2' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 18,
          ),
        ),
        'h3' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 13.5,
          ),
        ),
        'h4' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 12,
          ),
        ),
        'h5' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 10,
          ),
        ),
        'h6' => 
        array (
          'font' => 
          array (
            'bold' => true,
            'size' => 7.5,
          ),
        ),
        'a' => 
        array (
          'font' => 
          array (
            'underline' => true,
            'color' => 
            array (
              'argb' => 'FF0000FF',
            ),
          ),
        ),
        'hr' => 
        array (
          'borders' => 
          array (
            'bottom' => 
            array (
              'style' => 'thin',
              'color' => 
              array (
                0 => 'FF000000',
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
