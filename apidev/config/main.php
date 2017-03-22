<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    
    //增加模块
    'modules' => [
        'v1' => [
            'class' => 'apidev\modules\v1\Module',
        ],
    ],
    
    'id' => 'app-apidev',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'apidev\controllers',
    'components' => [
        
        //修改响应格式
        'response' => [
            'format' => 'json'
        ],
        
        'request' => [
            'csrfParam' => '_csrf-apidev',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
	        //启用自动登录功能
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-apidev', 'httpOnly' => true],
	        //关闭session功能
	        'enableSession' =>  false,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the apidev
            'name' => 'advanced-apidev',
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
       //启用路由控制
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' =>true,
            'rules' => [
                
                //解决严格解析后无法看到页面的问题 404 做一个映射 将nginx托管的页面放入严格解析页面
	            '/' => 'site/index',
                //解决启用'enableStrictParsing' =>true,抛出的404错误
                //'<controller:\w+>/<action:\w+>/<page:\d+>' => '<controller>/<action>',
               //'<controller:\w+>/<action:\w+>' => '<controller>/<action>' ,
                //配置restful
                [
                'class' => 'yii\rest\UrlRule',
                'controller' => ['v1/user'],
                //增加额外的模式
	                'extraPatterns'     => [
	                'POST Login'        =>      'login',
		                //仅用于添加测试用户
		            'GET signup-test'   =>      'signup-test',
	                ],
                ]
            ],
        ],
        
    ],
    'params' => $params,
];
