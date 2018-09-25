<?php

return [
    /**
     * enter app id and app secret of your facebook app here.
     * these values are required for the polling to work.
     */
    'facebook_app_id'     => env('FACEBOOK_APP_ID'),
    'facebook_app_secret' => env('FACEBOOK_APP_SECRET'),

    /**
     * configuration for the caching decorator.
     */
    'caching'             => [
        'enabled' => false,
        /**
         * the prefix for the generated cache key
         */
        'prefix'  => 'cb-fr',
        /**
         * the number in minutes the data should be cached
         */
        'ttl'     => 60,
    ],
];
