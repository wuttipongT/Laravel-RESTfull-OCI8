<?php

return [
    'oracle' => [
        'driver'        => 'oracle',
        'tns'           => env('DB_TNS', ''),
        'host'          => env('DB_HOST', '129.3.26.5'),
        'port'          => env('DB_PORT', '1521'),
        'database'      => env('DB_DATABASE', 'ORCL'),
        'username'      => env('DB_USERNAME', 'SFCORCL'),
        'password'      => env('DB_PASSWORD', 'SFCORCL'),
        'charset'       => env('DB_CHARSET', 'AL32UTF8'),
        'prefix'        => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        'options' => [
                PDO::ATTR_CASE => PDO::CASE_UPPER,
            ],
    ],
];
