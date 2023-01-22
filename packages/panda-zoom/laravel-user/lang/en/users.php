<?php

return [
    'common' => [
        'messages' => [
            'error_401_create' => 'Denied. You have not permissions to create a new user.',
            'error_403_user_deactivated' => 'Denied. Your account is deactivated.',
            'error_403_update' => 'Denied. You have not permissions update user ID # :id.',
            'error_403_delete' => 'Denied. You have not permissions delete user ID # :id.',
            'error_500_user_not_created' => 'User is not created.',
            'error_500_user_not_updated' => 'User is not updated.',
            'error_500_user_not_deleted' => 'User is not deleted.',
            'error_500_user_not_restored' => 'User is not restored.',
        ],

        'attributes' => [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'active' => 'Active',
            'locale' => 'Locale',
            'timezone' => 'TimeZone',
        ],
    ],
];
