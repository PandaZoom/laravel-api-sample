<?php

return [
    'common' => [
        'messages' => [
            'error_401_create' => 'Denied. You have not permissions to create a new status.',
            'error_403_user_deactivated' => 'Denied. Your account is deactivated.',
            'error_403_update' => 'Denied. You have not permissions update Status ID # :id.',
            'error_403_delete' => 'Denied. You have not permissions delete Status ID # :id.',
            'error_500_not_created' => 'Status is not created.',
            'error_500_not_updated' => 'Status is not updated.',
            'error_500_not_deleted' => 'Status is not deleted.',
            'error_500_not_restored' => 'Status is not restored.',
        ],

        'attributes' => [
            'slug' => 'Slug',
            'user_id' => 'User ID',
        ],
    ],

    'delete' => [
        'attributes' => [
            'permanent' => 'Permanent'
        ]
    ]
];
