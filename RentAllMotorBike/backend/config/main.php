<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'aliases' => [
        '@adminlte/widgets'=>'@vendor/adminlte/yii2-widgets'
    ],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
        'cookieValidationKey' => 'qhh_D_rjXk5nFH4dD-liyIl0RNvRXU9R',

        'parsers' => [
            'application/json' => 'yii\web\JsonParser',
        ]
    ],

        'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'csrfParam' => '_csrf-backend',
            ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'user' => 'user/index',
                'admin/' => 'user/view',
                'admin' => 'user/update',
                'gestor' => 'user/view',

                    ['class' => 'yii\rest\UrlRule',
                        'controller' => 'api/user',
                        'pluralize' => false,
                    ],
                    ['class' => 'yii\rest\UrlRule',
                        'controller' => 'api/motociclo',
                        'pluralize' => false,
                    ],



                    ['class' => 'yii\rest\UrlRule', 'controller' => 'analises', 'pluralize' => false,],

                    ['class' => 'yii\rest\UrlRule', 'controller' => 'Assistencia'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'DetalhesAluguer'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'api/extra', 'pluralize' => false],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'ExtraDetalhesAluguer'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'Fatura'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'Imagem'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'LinhaFatura'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'Localizacao'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'Profile'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'Login'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'Seguro'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'TipoMotociclo'],


            ],
        ],

    ],
    'params' => $params,
];