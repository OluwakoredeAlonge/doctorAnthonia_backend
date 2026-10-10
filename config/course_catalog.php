<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Partner Courses API
    |--------------------------------------------------------------------------
    |
    | Connection details for the Heirs courses API (GET /api/courses,
    | authenticated with a Sanctum bearer token). Called server-side only;
    | the token must never reach the browser. When either value is empty
    | the feature is simply off and the Courses page shows local courses only.
    |
    */

    'base_url' => env('COURSES_API_BASE_URL'),

    'token' => env('COURSES_API_TOKEN'),

    'timeout' => (int) env('COURSES_API_TIMEOUT', 10),

    // Seconds the pulled catalogue is cached, so visitors don't hit the
    // partner API on every page load.
    'cache_ttl' => (int) env('COURSES_API_CACHE_TTL', 300),

    // Seconds to skip the API entirely after a failed fetch, so an outage
    // doesn't make every visitor wait out the timeout.
    'failure_backoff' => 60,

    /*
    |--------------------------------------------------------------------------
    | Public Fields Allow-List
    |--------------------------------------------------------------------------
    |
    | Only these fields are kept from each partner course. The API also
    | returns gated content ('weeks' with YouTube links, 'materials' with
    | download URLs) which is deliberately left off and never rendered here.
    |
    */

    'public_fields' => [
        'slug',
        'title',
        'details',
        'price',
        'original_price',
        'discount_percentage',
        'image_url',
        'has_certificate',
        'is_lifetime_access',
        'access_duration_months',
        'category',
    ],

];
