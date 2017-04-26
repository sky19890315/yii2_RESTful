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
    	//增加后台部分模块
	    'module' => [
		    'class' => 'backend\modules\Module',
	    ],
	    
	    //增加后台模块管理
	    'admin' =>  [
	        'class' =>  'mdm\admin\Module',
	    ],
	    
	    /**
	     * 设置别名
	     * 别名的好处是不涉及绝对路径 对数据迁移很有好处
	     */
	    'aliases'   =>  [
	        '@mdm/admin'    =>  '@vendor/mdmsoft/yii2-admin',
	    ],
	    
	    
	    
	    
    ],
	
	
	/**
	 *  2017-04-12 最新修改
	 * 因为 之前把这个配置文件放入组件中 直接导致出错 现在给予修改
	 * 修复未登录用户也能访问的bug
	 * 只要不修改  以下的* 则权限管理系统不生效
	 */
    'as access'         =>  [
	    'class'         =>  'mdm\admin\components\AccessControl',
	    'allowActions'  =>  [
		
		    /**
		     * 存放允许访问的action
		     * 格式为 controller/action
		     * 现在 * 表示放行所有控制器的动作
		     */
		    
		    '*',
	    ],
    ],
	
    'components' => [
	
	'language' => 'zh-CN',
        //增加
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red',
                ],
            ],
        ],
        //以上为增加
	    
	    /**
	     * 增加认证管理↓
	     * 这条认证原理是所有用户登录后默认角色为 guest 即游客
	     * 2017-04-16 将这套用于API管理
	     */
	    'authManager'       =>  [
	    	'class'         =>  'yii\rbac\DbManager',
		    'defaultRoles'  =>  ['guest'],
	    ],

	    
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        
	    /**
	     * 启用独立的后台验证机制
	     */
        'user' => [
        	
	        /**
	         * 默认类修改为后台管理验证机制
	         * 避免与前台发生冲突
	         */
            'identityClass'     =>      'backend\models\AdminUser',
            'enableAutoLogin'   =>      true,
           // 'identityCookie'    =>      ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
	        
        	/**
	         * this is the name of the session cookie used for login on the backend
	         * 区分出前后台的session是为了解决后台登录后 前台也登录的问题
	         */
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
	
	        /**
	         * 增加URL格式  2017-04-17
	         */
	       // 'urlFormat'=>'path',
	        
        	//是否启用路由美化
            'enablePrettyUrl'                   => true,
	        //是否忽略index.php
            'showScriptName'                    => false,
	        //是否启用严格脚本解析
	        'enableStrictParsing'               => false,
            'rules' => [
            	'/' => 'site/index',
	        '<controller:\w+>/<action:\w+>'     =>  '<controller>/<action>',
	       
	            
	            
	        //'suffix' => '.html',
            ],
        ],
        
    ],
    'params' => $params,
];
