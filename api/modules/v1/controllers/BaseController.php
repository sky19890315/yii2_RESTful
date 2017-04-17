<?php
	
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
	
	namespace api\modules\v1\controllers;
	
	use yii\rest\ActiveController;
	use yii\web\Response;

	
	/**
	 * Class BaseController
	 * @package api\modules\v1\controllers
	 * 作为统一的JSON格式父类
	 * 增加授权认证的方式 以及其它
	 * yii\rest\ActiveController 额外提供一下功能:
	 * 1 一系列常用动作: index, view, create, update, delete, options;
	 * 2 对动作和资源进行用户认证.
	 * 当创建一个新的控制器类，控制器类的命名最好使用资源
	 * 名称的单数格式，例如，提供用户信息的控制器 可命名为UserController.
	 * 创建新的动作和Web应用中创建操作类似，唯一的差别是Web应用中
	 * 调用render()方法渲染一个视图作为返回值，对于RESTful动作 直接返回数据
	 */
	class BaseController extends ActiveController
	{
		/**
		 * @return array
		 * RESTful APIs 通常是无状态的， 也就意味着不应使用sessions 或 cookies，
		 * 因此每个请求应附带某种授权凭证，因为用户授权状态可能没通过sessions 或 cookies维护，
		 * 常用的做法是每个请求都发送一个秘密的access token来认证用户， 由于access token可以唯一识别和认证用户，
		 * API 请求应通过HTTPS来防止man-in-the-middle (MitM) 中间人攻击.
		 * 下面有几种方式来发送access token：
		 * 1 HTTP 基本认证: access token 当作用户名发送，应用在access token可安全存在API使用端的场景，
		 * 例如，API使用端是运行在一台服务器上的程序。
		 * 2 请求参数: access token 当作API URL请求参数发送，例如 https://example.com/users?access-token=xxxxxxxx ，
		 * 由于大多数服务器都会保存请求参数到日志， 这种方式应主要用于JSONP 请求，因为它不能使用HTTP头来发送access token
		 * 3 OAuth 2: 使用者从认证服务器上获取基于 OAuth2协议的access token，然后通过 HTTP Bearer Tokens 发送到API 服务器。
		 */
		public function behaviors ()
		{
			/**
			 * 1 allow： 指定该规则是 "允许" 还是 "拒绝" 。（译者注：true是允许，false是拒绝）
			 * 2 actions：指定该规则用于匹配哪些动作。 它的值应该是动作方法的ID数组。匹配比较是大小写敏感的。
			 * 如果该选项为空，或者不使用该选项， 意味着当前规则适用于所有的动作。
			 * 3 controllers：指定该规则用于匹配哪些控制器。 它的值应为控制器ID数组。匹配比较是大小写敏感的。
			 * 如果该选项为空，或者不使用该选项， 则意味着当前规则适用于所有的动作。
			 * （译者注：这个选项一般是在控制器的自定义父类中使用才有意义）
			 * 4 roles：指定该规则用于匹配哪些用户角色。 系统自带两个特殊的角色，通过 yii\web\User::isGuest 来判断：
			 * ?： 用于匹配访客用户 （未经认证）
			 * @： 用于匹配已认证用户
			 * 使用其他角色名时，将触发调用 yii\web\User::can()，这时要求 RBAC 的支持
			 * 如果该选项为空或者不使用该选项，意味着该规则适用于所有角色。
			 *
			 * verbs：指定该规则用于匹配哪种请求方法（例如GET，POST）。 这里的匹配大小写不敏感。
			 *
			 */
			$behaviors = parent::behaviors();
			/*
			 * 内容协商 contentNegotiator 协商输出格式为json
			 * */
			$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
			
			
			return $behaviors;
		}
		
		/**
		 * 20170412 后期可以考虑禁用的选项 例如调试阶段禁止用户增加或者删除用户等
		 * 因为目前暂时不使用 所以所有的方法先注释掉
		 * 需要使用的时候直接取消注释
		 * @author sky 296675685@qq.com
		 * @return  null
		 */
	}
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	