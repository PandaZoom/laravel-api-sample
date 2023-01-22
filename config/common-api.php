<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api route prefix
    |--------------------------------------------------------------------------
    */

    'api_prefix' => env('API_PREFIX', 'api'),

    'api_url' => env('API_URL', 'http://localhost'),

    /*
    |----------------------------------------------------------------------
    | Group Main Validation ValidationRules
    |----------------------------------------------------------------------
    */

    'rules' => [

        'email' => [
            'min' => (int) env('VALIDATION_RULE_EMAIL_MIN', 6),
            'max' => (int) env('VALIDATION_RULE_EMAIL_MAX', 200),
        ],

        'password' => [
            'min' => (int) env('VALIDATION_RULE_PASSWORD_MIN', 8),
            'max' => (int) env('VALIDATION_RULE_PASSWORD_MAX', 200),
        ],

        'first_name' => [
            'max' => (int) env('VALIDATION_RULE_USER_FIRST_NAME_MAX', 100),
        ],

        'last_name' => [
            'max' => (int) env('VALIDATION_RULE_USER_LAST_NAME_MAX', 100),
        ],

        'slug' => [
            'max' => (int) env('VALIDATION_RULE_SLUG_MAX', 100),
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Available request keys for advanced resources at response
    |----------------------------------------------------------------------
    */

    'request_key' => [
        'include' => 'include',
        'filter' => 'filter',
        'with' => 'with',
    ],
];
