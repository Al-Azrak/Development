<?php
return [
    'template' => [
        'wrapper_start' => TEMPLATE_PATH.'templateHeaderEnd.php',
        'header' => TEMPLATE_PATH.'header.php',
        'nav' => TEMPLATE_PATH.'nav.php',
        'view' => ':action_view',
        'wrapper_end' => TEMPLATE_PATH.'templateHeaderEnd.php'
    ],
    'header_resources' => [
        'css' => [
            'normalize' => CSS.'normalize.css',
            'fawesome' => CSS.'',
            'gicon' => CSS.'',
            'main' => CSS.''
        ],
        'js' => [

        ]
    ],
    'footer_resources' => [
        'jquery' => JS.'',
        'helper' => JS.'',
        'main' => JS.''
    ]
];