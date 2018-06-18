<?php

return [
    'api_version' => '1.0',

    'token_type' => 'Bearer',

    'client_id' => env('TABOOLA_CLIENT_ID', null),
    'client_secret' => env('TABOOLA_CLIENT_SECRET', null),
    'client_name' => env('TABOOLA_ACCOUNT_NAME',null)
];