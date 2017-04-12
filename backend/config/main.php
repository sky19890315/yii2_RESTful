<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
	
	//尝试修改默认路由
	//'defaultRoute'  =>  'index/index',
	//以上为选择默认控制器IndexController下的index方法
	
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    	//增加后台部分模块
	    'module' => [
		    'class' => 'backend\modules\Module',
	    ],
	    
	    //增加后台模块管理
	    'admin' =>  [
	        'class' =>  'mdm\admin\Module',
	    ],
	    
	    //设置别名
	    'aliases'   =>  [
	        '@mdm/admin'    =>  '@vendor/mdmsoft/yii2-admin',
	    ],
	    
	    
	    
	    
    ],
	
	
	/**
	 *  2017-04-12 最新修改
	 * 因为 之前把这个配置文件放入组件中 直接导致出错 现在给予修改
	 * 修复未登录用户也能访问的bug
	 */
    'as access'         =>  [
	    'class'         =>  'mdm\admin\components\AccessControl',
	    'allowActions'  =>  [
		    //存放允许访问的action
		    //controller/action
		    '*',
	    ],
    ],


    'components' => [
        //增加
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red',
                ],
            ],
        ],
        //以上为增加
	    
	    //增加认证管理↓
	    'authManager'       =>  [
	    	'class'         =>  'yii\rbac\DbManager',
		    'defaultRoles'  =>  ['guest'],
	    ],

	    
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        
        //修改用户验证机制
        'user' => [
            //修改默认类
            'identityClass'     =>      'backend\models\UserBackend',
            'enableAutoLogin'   =>      true,
           // 'identityCookie'    =>      ['name' => '_identity-backend', 'httpOnly' => true],
        ],
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
        
	    
	    //20170324修改路由管理功能
        'urlManager'                => [
        	//是否启用路由美化
            'enablePrettyUrl'                   => true,
	        //是否忽略index.php
            'showScriptName'                    => false,
	        //是否启用严格脚本解析
	        'enableStrictParsing'               => false,
            'rules' => [
	        '<controller:\w+>/<action:\w+>'     =>  '<controller>/<action>',
	        //'suffix' => '.html',
            ],
        ],
        
    ],
    'params' => $params,
];
