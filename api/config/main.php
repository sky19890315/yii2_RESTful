<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        //增加v1类支持
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
    ],
    'components' => [
        //增加响应格式
	    //再次修改响应格式20170321
        'response' => [
        	'class'             =>  'yii\web\Response',
	        'on beforeSend'     =>  function ($event){
				$response = $event->sender;
				//指定返回的数据
				$response->format = yii\web\Response::FORMAT_JSON;
	        },
        ],
        'request' => [
            'csrfParam' => '_csrf-api',
        ],
        'user' => [
            'identityClass'     =>      'common\models\User',
            'enableAutoLogin'   =>      true,
            'identityCookie'    =>      ['name' => '_identity-api', 'httpOnly' => true],
	        //关闭session
	        'enableSession'     =>      false,
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
        //restful路由美化功能开启
        'urlManager' => [
	
	        /**
	         * 增加对userProfile的操作
	         */
	        'extraPatterns' => [
	        	'POST login'        => 'login',
		        'GET signup-test'   =>  'signup-test',
		        'GET user-profile'  =>  'user-profile',
	        ],
	        
            'enablePrettyUrl'       => true,
            'showScriptName'        => false,
            'enableStrictParsing'   => true,
            'rules' => [
                [
                'class'             =>  'yii\rest\UrlRule',
                'controller'        =>  ['v1/user'],
	                //启用post
                'POST login'        =>  'login',
	                //测试登录
	            'GET signup-test'   =>  'signup-test'
                ]
            ],
        ],

    ],
    'params' => $params,
];
