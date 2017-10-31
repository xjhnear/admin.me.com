<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-test.php')
);


$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ztw386uK7w0GSrGAUBePXPHVFB62Abb0',
        ],
        'apiDb' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=cinderellar',
            'username' => 'llroot',
            'password' => '8888zz980ZZ',
            //release
            //'dsn' => 'mysql:host=121.40.79.48;dbname=cinderellar',
            //'username' => 'root',
            //'password' => '8c197f7093',
            //debug
            'charset' => 'utf8mb4',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
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
