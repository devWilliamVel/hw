<?php

return [
    'http_response' => [
        // SUCCESS
        'ok' => 200,
        'created' => 201,
        'accepted' => 202,
        'no_content' => 204,
        // REDIRECT
        'multiple_choises' => 300,
        'moved_permanently' => 301,
        'found' => 302,
        // CLIENT ERROR
        'bad_request' => 400,
        'unauthorized' => 401,
        'payment_required' => 402,
        'forbidden' => 403,
        'not_found' => 404,
        // SERVER ERROR
        'internal_server_error' => 500,
    ],
];
