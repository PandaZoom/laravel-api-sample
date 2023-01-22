<?php

return [

    'common' => [
        'messages' => [
            'error_400' => 'Bad Request.',
            'error_400_empty_income_data' => 'Bad Request. Empty request data.',
            'error_401_create' => 'Unauthorized. Please authorize for create :Resource.',
            'error_403_create' => 'Denied. You have not permissions create the resource.',
            'error_403_update' => 'Denied. You have not permissions update :Resource.',
            'error_403_delete' => 'Denied. You have not permissions delete :Resource.',
            'error_403_deactivated' => 'Denied. :Resource ID: :id is deactivated.',
            'error_404' => 'Not found.',
            'error_406' => 'Not present required header.',
            'error_422' => 'Unprocessable Entity.',
            'error_500' => 'Something went wrong. Try again later.',
            'error_500_model_not_created' => 'Model not created. Try again later.',
            'error_500_model_not_updated' => 'Model not updated. Try again later.',
            'error_500_model_not_deleted' => 'Model not deleted. Try again later.',
            'error_503_maintenance_mode' => 'App under maintenance. We will back as soon is possible.',
        ],
    ],

    'store' => [
        'messages' => [
            'success' => 'Successful created.',
        ],
    ],

    'update' => [
        'messages' => [
            'success' => 'Successful updated.',
        ],
    ],

    'destroy' => [
        'messages' => [
            'success' => 'Successful deleted.',
        ],
    ],

    'restore' => [
        'messages' => [
            'success' => 'Successful restored.',
        ],
    ],

    'delete' => [
        'messages' => [
            'success' => 'Successful permanent deleted.',
        ],
    ],
];
