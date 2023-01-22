<?php

return [
    'common' => [
        'messages' => [
            'error_400_missing_translations' => 'Missing article translations.',
            'error_401_create' => 'Denied. You have not permissions to create a new article.',
            'error_403_user_deactivated' => 'Denied. Your account is deactivated.',
            'error_403_update' => 'Denied. You have not permissions update Article ID # :id.',
            'error_403_delete' => 'Denied. You have not permissions delete Article ID # :id.',
            'error_500_not_created' => 'Article is not created.',
            'error_500_not_updated' => 'Article is not updated.',
            'error_500_not_deleted' => 'Article is not deleted.',
            'error_500_not_restored' => 'Article is not restored.',
            'error_500_translation_not_created' => 'Article translation is not created.',
            'error_500_translation_not_updated' => 'Article translation is not updated.',
        ],

        'attributes' => [
            'status_id' => 'Status ID',
            'published_at' => 'Published At',
            'expires_at' => 'Expires At',
            'translations' => 'Translations',
            'title' => 'Title',
            'description' => 'Description',
            'name' => 'Name',
            'summary' => 'Summary',
            'story' => 'Story',
        ],
    ],

    'delete' => [
        'attributes' => [
            'permanent' => 'Permanent',
        ],
    ]
];
