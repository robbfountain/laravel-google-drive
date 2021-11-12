<?php

return [

    /**
     * This is the credentials file needed to authenticate
     * to the Google Drive API
     */
    'credentials_file' => storage_path('app/credentials.json'),

    /**
     * The allowed scopes for API call
     */
    'scopes' => [
        \Google_Service_Drive::DRIVE,
    ]
];
