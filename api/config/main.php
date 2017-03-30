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
            'class' => 'api\modules\v1\Module',
        ],
    ],
    
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        
        //修改响应格式
        'response' => [
            'format' => 'json'
        ],
        
        'request' => [
        	//'format'    =>  'json',
            'csrfParam' => '_csrf-api',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
	        //启用自动登录功能
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
	        //关闭session功能
	        'enableSession' =>  false,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
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
	           //测试试验台
               // 'controller' => ['v1/stations'],
	           //测试goods
	              // 'controller'     =>      ['v1/goods'],
	              //  'controller'      =>        ['v1/cars'],
                    'controller'        =>      ['v1/stations'],
                ]
            ],
        ],
        
    ],
    'params' => $params,
];
