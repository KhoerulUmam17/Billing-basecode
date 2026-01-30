<?php

return [


    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'midtrans' => [
        'merchant_id' => env('MIDTRANS_MERCHANT_ID', 'G926271204'),
        'client_key' => env('MIDTRANS_CLIENT_KEY', 'Mid-client-NbUHLL3qCzHU-EHs'),
        'server_key' => env('MIDTRANS_SERVER_KEY', 'Mid-server-6o9mgxH5RgNVb1M7MAhWMg28'),
        'is_production' => false, // Sandbox mode
        'api_url' => 'https://api.sandbox.midtrans.com',
    ],

];
