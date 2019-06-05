<?php

return [
    'app' => env('LOG_APP_NAME', env('APP_NAME')),

    'level' => env('LOG_MONOLOG_LEVEL', env('APP_LOG_LEVEL', 'debug')),

    'host' => env('LOG_MONOLOG_HOST'),

    'port' => env('LOG_MONOLOG_PORT', 12201),
];
