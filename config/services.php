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
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
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

    'airtable' => [
        'base_url' => env('AIRTABLE_BASE_URL'),
        'bearer_token' => env('AIRTABLE_BEARER_TOKEN'),
        'workspace_id' => env('AIRTABLE_WORKSPACE_ID'),
        'bases_path' => env('AIRTABLE_BASES_PATH'),
    ],

    'notion' => [
        'version' => env('NOTION_VERSION'),
        'host_name' => env('NOTION_HOST_NAME'),
        'users_endpoint' => env('NOTION_USERS_ENDPOINT'),
        'databases_endpoint' => env('NOTION_DATABASES_ENDPOINT'),
        'data_sources_endpoint' => env('NOTION_DATA_SOURCES_ENDPOINT'),
        'pages_endpoint' => env('NOTION_PAGES_ENDPOINT'),
    ],

    'todoist' => [
        'host_name' => env('TODOIST_HOST_NAME'),
        'user_endpoint' => env('TODOIST_USER_ENDPOINT'),
        'sync_endpoint' => env('TODOIST_SYNC_ENDPOINT'),
        'sections_endpoint' => env('TODOIST_SECTIONS_ENDPOINT'),
        'projects_endpoint' => env('TODOIST_PROJECTS_ENDPOINT'),
    ],

    'spaces' => [
        'endpoint' => env('SPACES_ENDPOINT'),
    ]
];
