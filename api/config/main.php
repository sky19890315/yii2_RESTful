<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    
    
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ]
        
    ],
    'components' => [
        //增加用户授权
        'user' => [
            'identityClass' => 'common\models\User',
        'enableAutoLogin' => true,
        'enableSession' => false,
        ],
        /*+++++++++++++++++++----*/
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        //delete
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*增加路由美化功能*/
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' =>true,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/goods'],
                    
                ],
                
            ],
        ],
        
        
        
        
        
    ],
    'params' => $params,
];
