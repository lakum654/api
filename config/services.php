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

    'google' => [
        'client_id' => '169933478912-0sp9aq0rokmm3pcetrflg7ciguvphgoj.apps.googleusercontent.com',
        'client_secret' => 'gS_9RjYEZdUCXWcU_XNcnJgX',
        'redirect' => 'http://localhost/angelspearlinfoteach/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '524653302238035',
        'client_secret' => '0d4ac32b1f892d9169fa6a05130133e2',
        'redirect' => 'http://localhost/angelspearlinfoteach/auth/facebook/callback',
    ],

    'github' => [
        'client_id' => '478260f9df306b2fdde9',
        'client_secret' => '66c7199bb048e72cdabccdc888ff46a8b0762672',
        'redirect' => 'http://localhost/angelspearlinfoteach/auth/github/callback',
    ],


];
