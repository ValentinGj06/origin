<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Пристап',

            'roles' => [
                'all' => 'Сите Улоги',
                'create' => 'Креирај',
                'edit' => 'Edit Role',
                'management' => 'Менаџирање на улоги',
                'main' => 'Roles',
            ],

            'users' => [
                'all' => 'Сите Корисници',
                'change-password' => 'Change Password',
                'create' => 'Create Корисник',
                'deactivated' => 'Deactivated Корисници',
                'deleted' => 'Deleted Корисници',
                'edit' => 'Edit Корисник',
                'main' => 'Корисници',
                'view' => 'View Корисник',
            ],
        ],

        'clients' => [
            'title' => 'Клиенти',

            'clients' => [
                'all' => 'Сите Клиенти',
                'change-password' => 'Change Password',
                'create' => 'Create Клиент',
                'deactivated' => 'Deactivated Клиенти',
                'deleted' => 'Deleted Клиенти',
                'edit' => 'Edit Клиент',
                'main' => 'Клиенти',
                'view' => 'View Клиент',
            ],
        ],

        'log-viewer' => [
            'main' => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs' => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Табла',
            'general' => 'Герерално',
            'history' => 'Историја',
            'system' => 'Систем',
            'clients' => 'Клиенти',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            // 'ar' => 'Arabic',
            // 'az' => 'Azerbaijan',
            // 'zh' => 'Chinese Simplified',
            // 'zh-TW' => 'Chinese Traditional',
            // 'da' => 'Danish',
            // 'de' => 'German',
            // 'el' => 'Greek',
            'en' => 'English',
            // 'es' => 'Spanish',
            // 'fa' => 'Persian',
            // 'fr' => 'French',
            // 'he' => 'Hebrew',
            // 'id' => 'Indonesian',
            // 'it' => 'Italian',
            // 'ja' => 'Japanese',
            'mk' => 'Македонски',
            // 'nl' => 'Dutch',
            // 'no' => 'Norwegian',
            // 'pt_BR' => 'Brazilian Portuguese',
            // 'ru' => 'Russian',
            // 'sv' => 'Swedish',
            // 'th' => 'Thai',
            // 'tr' => 'Turkish',
            // 'uk' => 'Ukrainian',
        ],
    ],
];
