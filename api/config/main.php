<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
	
/*
                           _ooOoo_
                          o8888888o
                          88" . "88
                          (| -_- |)
                          O\  =  /O
                       ____/`---'\____
                     .'  \\|     |//  `.
                    /  \\|||  :  |||//  \
                   /  _||||| -:- |||||-  \
                   |   | \\\  -  /// |   |
                   | \_|  ''\---/''  |   |
                   \  .-\__  `-`  ___/-. /
                 ___`. .'  /--.--\  `. . __
              ."" '<  `.___\_<|>_/___.'  >'"".
             | | :  `- \`.;`\ _ /`;.`/ - ` : | |
             \  \ `-.   \_ __\ /__ _/   .-` /  /
        ======`-.____`-.___\_____/___.-`____.-'======
                           `=---='
        ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
                 佛祖保佑       永无BUG
        */

return [
    
    /*
     * 目前在用版本的restful端
     *
     * */
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
	
	    /**
	     * 增加v2版本模块
	     *         'v2' => [
	     * 'class' => 'api\modules\v2\Module',
	     *   ],
	     */
    ],
    
    'id' => 'app-api',
    'basePath'  => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
	
	    /**
	     * @return mixed
	     * 20170411 增加登录验证授权 omg sky 296675685@qq.com
	     * 任性
	     * 认证类 选择 common\models\User
	     */
	    'user' => [
		    'identityClass' => 'common\models\User',
		    //启用自动登录功能
		    'enableAutoLogin' => true,
		    'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
		    //关闭session功能
		    'enableSession' =>  false,
	    ],
    	
    	
        //修改响应格式
	    //恢复响应格式 20170406
       'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
	       'charset' => 'UTF-8',
        ],
        
        'request' => [
            'csrfParam' => '_csrf-api',
	        //修改 使API接受JSON格式输入的数据
	        'parsers' => [
	        	'application/json' => 'yii\web\JsonParser',
	        ],
        ],
     
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                ['class' => 'yii\log\FileTarget', 'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
	
	    /**
	     * 改动这里面的代码绝对会产生神奇的效果
	     */
        'urlManager' => ['enablePrettyUrl' => true,
                         'showScriptName' => false,
                         'enableStrictParsing' => true,
             
         'rules' => [
	
	              /**
	               * 首页路由
	               * 解决严格解析后无法看到页面的问题 404 做一个映射 将nginx托管的页面放入严格解析页面
	               * 解决启用'enableStrictParsing' =>true,抛出的404错误
	               */
	        '/' => 'site/index',
	        '/v1/file'  =>  'file/index'  ,
	         
	              /**
	               *  上传页面 优化替换成file 在文件管理页面
	               *  隐藏实际路由
	               */
	        '/v1/file/upload'    =>  'upload/index',
	              
	              //下载文件页面
	        'v1/file/download'   =>   'download/index',
	
	         /**
	          * 20170411 祭出下面神器是为了能直接用控制器/动作的方式访问路由而不出错
	          * 因为yii2的路由设置为严格解析后就有这种后果 删除无效的
	          */
	   '<controller:\w+>/<action:\w+>' => '<controller>/<action>' ,
	        
	         /**
	          * 以下是实现restful路由的基石
	          */
	        ['class'      =>    'yii\rest\UrlRule',
		       
		     'controller' => ['v1/stations', 'v1/users', 'v1/upload' ],
		        
		   /**
		    * 如果出现不可预测的bug 可以将以下代码注释掉
		    */
		    'extraPatterns'     =>   [
		        'POST login'        =>   'login',
			    'GEt signup-test'   =>    'signup-test',
			    'GET user-profile'  =>    'user-profile',
		    ],
		   
	        ],
	            
	         /**
	          * 实际上v2版本并没有启用
	          * 20170329增加v2版本
	          * ['class' => 'yii\rest\UrlRule', 'controller' => ['v2/user', 'v2/post']],
	          */
	            
	            
            ],
        ],
        
    ],
    'params' => $params,
];
