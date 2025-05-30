<?php
return [
    'name' => 'نظام المواعيد',
    'language' => 'ar',
    'timeZone' => 'Asia/Gaza', // أو 'Asia/Jerusalem' حسب المنطقة

    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
];
