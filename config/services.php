<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Netopia Payment Gateway
    |--------------------------------------------------------------------------
    */

    'netopia' => [
        'merchant_id' => env('NETOPIA_MERCHANT_ID'),
        'public_key' => env('NETOPIA_PUBLIC_KEY'),
        'private_key' => env('NETOPIA_PRIVATE_KEY'),
        'signature' => env('NETOPIA_SIGNATURE'),
        'sandbox' => env('NETOPIA_SANDBOX', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Revolut Payment Gateway
    |--------------------------------------------------------------------------
    */

    'revolut' => [
        'api_key' => env('REVOLUT_API_KEY'),
        'merchant_id' => env('REVOLUT_MERCHANT_ID'),
        'webhook_secret' => env('REVOLUT_WEBHOOK_SECRET'),
        'sandbox' => env('REVOLUT_SANDBOX', true),
    ],

];
