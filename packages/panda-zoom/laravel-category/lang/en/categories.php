<?php

return [

    'common'=> [

        'messages' => [
            'error_403_create' => 'Denied. You have not permissions create the category.',
            'error_403_deactivated' => 'Denied. The category ID :id is deactivated.',
            'error_403_update' => 'Denied. You have not permissions update the category ID # :id.',
            'error_403_delete' => 'Denied. You have not permissions delete the category ID # :id.',
            'error_500_category_not_created' => 'Category is not created.',
            'error_500_category_not_updated' => 'Category is not updated.',
            'error_500_category_not_deleted' => 'Category is not deleted.',
            'error_500_category_not_restored' => 'Category is not restored.',
            'error_500_translation_not_created' => 'Category translations is not created.',
            'error_500_translation_not_updated' => 'Category translations is not updated.',
        ],

        'attributes' => [
            'active' => 'Active',
            'position' => 'Position',
            'translations' => 'Translations',
            'locale' => 'Locale',
            'name' => 'Name',
        ]
    ],
];
