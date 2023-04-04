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
    'rura' => [
        'username' => env('RURA_USERNAME', 'misuser'),
        'password' => env('RURA_PASSWORD', 'ubutabiire'),
        'sms_url' => env('RURA_SMS_URL', 'http://10.10.30.26/api/sendsms'),
        'sender_name' => env('RURA_SENDER_NAME', 'rura')
    ],
    'besoft' => [
        'sms_url' => env('BESOFT_SMS_URL', 'http://sms.besoft.rw/api/v1/client/bulksms'),
        'token' => env("BESOFT_TOKEN", "oe1MNXW6O8GdKmWM3nCSqoVROQSZD31O"),
        'sender_name' => env('BESOFT_SENDER_NAME', 'besoft')
    ],
    'CLMS_NIDA_URL' => env('CLMS_NIDA_URL', 'https://licensing.rura.rw/search-id-number'),
    'VAT_RATE' => env('VAT_RATE', 18),


];
