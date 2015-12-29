<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'work',
    'name' => 'Трудоустройство',
    'language' => 'ru',
    'sourceLanguage' => 'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Europe/Moscow',
    'modules' => [
        'admin' => [
            'layout' => 'top-menu', // default null. other avaliable value 'right-menu' and 'top-menu'
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'idField' => 'id', // id field of model User
                    'usernameField' => 'login', // id field of model User
                ]
            ],
            
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        // add or remove allowed actions to this list
        'allowActions' => [
            'site/index',
            'site/about',
            'site/error',
            'site/login',
            'site/logout',
        ]
    ],
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ]
            ],
        ],
        'formatter' => [
            'nullDisplay' => '',
            'decimalSeparator' => '.',
            'dateFormat' => 'dd.MM.Y',
            'timeFormat' => 'HH:mm:s',
            'datetimeFormat' => 'dd.MM.Y HH:mm:s',
        ],
        'authManager' => [
//            'class' => 'yii\rbac\DbManager',
            'class' => 'mdm\admin\components\DbManager',
            'cache' => 'cache',   // this enables RBAC caching
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mxL-m7nCsmVutfIgZNtF5EI1SvkHuSSh',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'session' => [
            'class' => 'yii\web\CacheSession',
            'timeout' => 3600,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {

//    $config['as access']['allowActions'][]='admin/*';
    $config['as access']['allowActions'][]='debug/*';
    $config['as access']['allowActions'][]='gii/*';

    $config['components']['log']['targets'][] = [
        'class' => 'yii\log\FileTarget',
        'levels' => ['info'],
        'categories' => ['dump'],
        'logFile' => '@app/runtime/logs/info.log',
        'maxFileSize' => 1024 * 2,
        'maxLogFiles' => 20,
    ];

    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.*', '178.158.147.93', '130.211.93.253', '*'],
        'generators' => [
            'crud' => [
//                'class'     => 'yii\gii\generators\crud\Generator',
                'class' => 'app\gii\crud\Generator',
                'templates' => ['mycrud' => '@app/gii/crud/default']
            ],
            'model' => [
                'class' => 'app\gii\model\Generator',
                'templates' => ['mymodel' => '@app/gii/model/default']
            ],
//            'crud1' => [
//                'class' => 'app\vendor\schmunk42\yii2-giiant\crud\Generator',
//                'templates' => ['mycrud' => '@app/gii/crud/default']
//            ]
        ]
    ];
}

//print_r($config);

return $config;
