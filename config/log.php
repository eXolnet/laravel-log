<?php

return [
    'app' => env('LOG_APP_NAME', env('APP_NAME')),

    'host' => env('LOG_MONOLOG_HOST'),

    'port' => env('LOG_MONOLOG_PORT', 12201),
];
