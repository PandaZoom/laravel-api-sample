<?php

return [
    'common' => [
        'messages' => [
            'error_401_create' => 'Denied. You have not permissions to create a new Comment.',
            'error_403_user_deactivated' => 'Denied. Your account is deactivated.',
            'error_403_update' => 'Denied. You have not permissions update Comment ID # :id.',
            'error_403_delete' => 'Denied. You have not permissions delete Comment ID # :id.',
            'error_500_not_created' => 'Comment is not created.',
            'error_500_not_updated' => 'Comment is not updated.',
            'error_500_not_deleted' => 'Comment is not deleted.',
            'error_500_not_restored' => 'Comment is not restored.',
        ],

        'attributes' => [
            'message' => 'Message',
            'user_id' => 'User ID',
        ],
    ],
];
