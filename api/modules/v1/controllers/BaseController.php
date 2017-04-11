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
	
	use yii\filters\auth\HttpBasicAuth;//增加认证类 20170411
	use yii\rest\ActiveController;
	use yii\web\Response;
	
	/**
	 * Class BaseController
	 * @package api\modules\v1\controllers
	 * 作为统一的JSON格式父类
	 * 增加授权认证的方式 以及其它
	 */
	class BaseController extends ActiveController
	{
		/**
		 * @return array
		 */
		public function behaviors ()
		{
			$behaviors = parent::behaviors();
			$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
			/*
			 * 目的在于设置授权认证体系  设置成功 首页访问正常
			 * */
			$behaviors['authenticator'] = [
				'class'     =>      HttpBasicAuth::className(),
			];
			
			return $behaviors;
		}
	}
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	