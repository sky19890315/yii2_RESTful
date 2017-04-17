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
	
	/**
	 * 2016-04-16 调用后台的验证机制
	 *
	 */
    
    /*
     * 目前在用版本的restful端
     *
     * */
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
	
	    /**
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     * 增加v2版本模块
	     *         'v2' => [
	     * 'class' => 'api\modules\v2\Module',
	     *   ],
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     */
	    
	    /**
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     * 增加权限访问控制系统 @author sky
	     * 296675685@qq.com
	     * 日期：2017-04-12
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     *
	     */
	    'admin' =>  [
	        'class' =>  'mdm\admin\Module',
	    ],
    ],//end of module
	
	/**
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 增加别名指向真实路径 @author sky
	 * 296675685@qq.com
	 * 日期：2017-04-12
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 */
	'aliases'   => [
		'@mdm/admin' => '@vendor/mdmsoft/yii2-admin'
	],
    
    'id' => 'app-api',
    'basePath'  => dirname(__DIR__),
	
	/**
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 有时你想在每个请求处理过程都实例化某个组件即便它不会被访问，
	 * 可以将该组件ID加入到应用主体的 bootstrap 属性中。
	 * 放入bootstap中的组件  会在每次请求中都会实例化一次
	 * 如log就是需要每次都写入log
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 */
    'bootstrap' => ['log'],
	
	/**
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 配置可以访问的动作  action    authManager  基于 DbManager
	 * @author sky
	 * 296675685@qq.com
	 * 日期：2017-04-12
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 */
    'as access' => [
	    'class' => 'mdm\admin\components\AccessControl',
	
	    /**
	     * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     * 以下是允许访问的action  不配置默认所有都不能访问
	     * 做到这里 返回BaseController 去修改访问的行为
	     * 以下的修改直接导致  控制器/方法  能否访问 ！！！！！！
	     * 用 '*' 表示开放所有权限
	     * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     */
	    'allowActions' => [
			'site/index',
		    '*',
	    ],
    ],
	
    'controllerNamespace' => 'api\controllers',
	
	
	
	
	/**
	 * 应用主体是服务定位器， 它部署一组提供各种不同功能的 应用组件 来处理请求。
	 * 例如，urlManager组件负责处理网页请求路由到对应的控制器。 db组件提供数据库相关服务等等。
	 * 例如，可以使用 \Yii::$app->db 来获取到已注册到应用的 DB connection，
	 * 使用 \Yii::$app->cache 来获取到已注册到应用的 primary cache。
	 * 第一次使用以上表达式时候会创建应用组件实例， 后续再访问会返回此实例，无需再次创建。
	 *  请谨慎注册太多应用组件， 应用组件就像全局变量， 使用太多可能加大测试和维护的难度。
	 * 一般情况下可以在需要时再创建本地组件。
	 * 所有注册进组件内的组件ID  都可以直接通过 \Yii::$app->compontID 来调用 所以要求组件 id 独一无二
	 *
	 */
    'components' => [
	    /**
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     * 2017-04-14
	     * 增加 oauth2 认证体系 如果出bug 可以考虑和是和 basic 认证冲突  basic认证为4-11 增加内容
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     */
	    
	    
		'authClientCollection'  => [
			'class' =>  'yii\authclient\Collection',
	    
	    'clients'    =>  [
	         'myserver' =>  [
	         	'class'         => 'yii\authclient\OAuth2',
		        'clientId'      =>  'unique clent_id',
		        'clientSecret'  =>  'client_secret',
		         'tokenUrl'     =>  'http://api.prmeasure.com/auth/token',
		         'apiBasicUrl'  =>  'http://api.prmeasure.com/api',
	         ],
	    ],

			
    ], //end of auth
	    
	    
	    /**
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     * @return mixed
	     * 20170411 增加登录验证授权 omg sky 296675685@qq.com
	     * 任性
	     * 认证类 选择 common\models\User
	     * 配置用户的相关信息  关闭session
	     * 设置 loginUrl 属性为null 显示一个HTTP 403 错误而不是跳转到登录界面.
	     * 在你的user identity class 类中实现 yii\web\IdentityInterface::findIdentityByAccessToken() 方法.
	     *
	     * 2017-04-17 修改为后台验证机制，并启用session功能  session 和后台保持一致
	     * 只要后台登录，则这里也保持登录状态
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     */
	    
	    /*
	    'user' => [
		
		    
		      调用与后台一致的验证机制
		     默认类修改为后台管理验证机制
		     避免与前台发生冲突
		     
		    'identityClass'     =>      'backend\models\AdminUser',
		    'enableAutoLogin'   =>      true,
		    // 'identityCookie'    =>      ['name' => '_identity-backend', 'httpOnly' => true],
	    ],
	    */
		
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
			'enableSession'=>false
		],
	    
	    
	    'session' => [
		
		    /**
		     * this is the name of the session cookie used for login on the backend
		     * 区分出前后台的session是为了解决后台登录后 前台也登录的问题
		     */
		    'name' => 'advanced-backend',
	    ],
	
	    /**
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     * 配置认证组件    authManager  基于 DbManager
	     * @author sky
	     * 296675685@qq.com
	     * 日期：2017-04-12
	     *
	     * 日期 ：2017-04-16
	     * 启用后台管理页面的验证机制
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     */
	    'authManager'   => [
	    	'class'     =>  'yii\rbac\DbManager',
		    /*
		     * 默认认证用户为访客 访客只允许访问API首页
		     * 基于本控制器下的所有访问都不属于访客能访问的范畴
		     * */
		    'defaultRoles' =>  ['guest'],
	    ],
	
	    /**
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     * 更新响应格式 避免显示空白页面  找不到页面统一返回 JSON 404 NOT FOUND
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     */
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
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     * urlManager组件负责处理网页请求路由到对应的控制器。
	     * 改动这里面的代码绝对会产生神奇的效果
	     * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	     */
        'urlManager' => ['enablePrettyUrl' => true,
                         'showScriptName' => false,
                         'enableStrictParsing' => true,
             
         'rules' => [
	              /**
	               * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	               * 首页路由
	               * 解决严格解析后无法看到页面的问题 404 做一个映射 将nginx托管的页面放入严格解析页面
	               * 解决启用'enableStrictParsing' =>true,抛出的404错误
	               * 这种拉风的写法虽然没什么卵用 但是看起来舒服
	               * @author sky 296675685@qq.com
	               * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	               */
	        '/' => 'site/index',
	        '/v1/file'  =>  'file/index'  ,
	         
	              /**
	               * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	               *  上传页面 优化替换成file 在文件管理页面
	               *  隐藏实际路由
	               * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	               */
	        '/v1/file/upload'    =>  'upload/index',
	         
	        'v1/file/download'   =>   'download/index',
	
	         /**
	          * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	          * 20170411 祭出下面神器是为了能直接用控制器/动作的方式访问路由而不出错
	          * 因为yii2的路由设置为严格解析后就有这种后果 删除无效的
	          * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	          */
	        '<controller:\w+>/<action:\w+>' => '<controller>/<action>' ,
	        
	         /**
	          * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	          * 以下是实现restful路由的基石
	          * controller 下面对应的都是控制器 如 v1/stations 是基于 stationsController
	          * 简化模型后 不再对应 控制器/方法 而是通过严格解析路由 负数形式解析出restful内容
	          * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	          */
	        ['class'      =>    'yii\rest\UrlRule',
		       
		     'controller' => ['v1/stations', 'v1/users', 'v1/upload', 'v1/admins', 'v1/testorders' ],
		        
		   /**
		    * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		    * 如果出现不可预测的bug 可以将以下代码注释掉
		    * 您也可以通过配置 patterns 或 extraPatterns 重新定义现有的模式或添加此规则支持的新模式。
		    * 通过末端 GET /users/search 可以支持新行为 search， 按照如下配置 extraPatterns 选项
		    * 额外模式 extraPatterns 例如如下为增加了 通过POST方法的 登录
		    * 通过get方法的登录 和用户配置
		    * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		    */
		   
		    'extraPatterns'     =>   [
		        'POST login'        =>   'login',
			    'GET signup-test'   =>    'signup-test',
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
