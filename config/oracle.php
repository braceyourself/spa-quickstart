<?php

return [
    'oracle-frca' => [
        'driver' => 'oracle',
        'service_name' => env('DB_FRCA_SERVICE_NAME',''),
        'host' => env('DB_FRCA_HOST', ''),
        'port' => env('DB_PORT', '1521'),
        'database' => env('DB_FRCA_DATABASE', ''),
        'username' => env('DB_USERNAME', ''),
        'password' => env('DB_PASSWORD', ''),
        'charset' => env('DB_CHARSET', 'AL32UTF8'),
        'prefix' => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', 'FRC'),
        'edition' => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
    'oracle-frc' => [
        'driver' => 'oracle',
        'service_name' => env('DB_FRC_SERVICE_NAME',''),
        'host' => env('DB_FRC_HOST', ''),
        'port' => env('DB_PORT', '1521'),
        'database' => env('DB_FRC_DATABASE', ''),
        'username' => env('DB_USERNAME', ''),
        'password' => env('DB_PASSWORD', ''),
        'charset' => env('DB_CHARSET', 'AL32UTF8'),
        'prefix' => env('DB_PREFIX', ''),
        'prefix_schema' => env('DB_SCHEMA_PREFIX', ''),
        'edition' => env('DB_EDITION', 'ora$base'),
        'server_version' => env('DB_SERVER_VERSION', '11g'),
    ],
];
