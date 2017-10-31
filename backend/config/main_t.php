<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-test.php')
);

return [
    'id' => 'app-backend',
    'name' => '<strong>MISS思念体</strong>后台管理',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'i18n' => [
            'translations' => [
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                ],
                'user*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@backend/messages',
                ]
            ],
        ],
        'apiDb' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=rds0955fa9c50e8535qc.mysql.rds.aliyuncs.com;dbname=cinderellar',
            'username' => 'cinderellar',
            'password' => '8888zz980ZZ',
            //release
            //'dsn' => 'mysql:host=121.40.79.48;dbname=cinderellar',
            //'username' => 'root',
            //'password' => '8c197f7093',
            //debug
            'charset' => 'utf8mb4',
        ],
        /** 重载admin视图 */
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@mdm/admin/views' => '@backend/views/admin',
                ],
            ],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
    'aliases' => [
        '@mdm/admin' => '@vendor/mdmsoft/yii2-admin'
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'debug/*',
            'admin/*',
            'gii/*',
        ]
    ],
];
