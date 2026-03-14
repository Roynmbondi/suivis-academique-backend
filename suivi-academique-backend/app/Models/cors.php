<?php
    return [

        'paths' => ['api/*', 'filiere', 'sanctum/csrf-cookie'],

        'allowed_methos' => ['*'],

        'allowed_origins' => [
            'http://localhost:4200'
        ],

        'allowed_origins_patters' => [],

        'allowed_headers' => ['*'],

        'exposed_headers' => [],

        'max_age' => 0,

        'supports_credentials' => true,
    ];


?>
