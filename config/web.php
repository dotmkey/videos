<?php

use app\src\domain\model\FileRepositoryInterface;
use app\src\domain\model\VideoRepositoryInterface;
use app\src\infrastructure\domain\model\FileRepository;
use app\src\infrastructure\domain\model\VideoRepository;
use yii\db\Connection;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerNamespace' => 'app\src\port\http\ssr',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'EfE0JBJevcr6WmGuiV7dB0hE-pNHsMBH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true
        ],
    ],
    'params' => $params,
    'container' => [
        'definitions' => [
            Connection::class => $db
        ],
        'singletons' => [
            VideoRepositoryInterface::class => ['class' => VideoRepository::class],
            FileRepositoryInterface::class => ['class' => FileRepository::class]
        ]
    ]
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
