<?php
	/**
	 * Created by PhpStorm.
	 * User: s
	 * Date: 17-4-14
	 * Time: 上午9:44
	 */
	namespace api\controllers;
	
	use Yii;
	use yii\web\Controller;
	use yii\web\Response;
	
	/**
	 * Class ApiController
	 * @package api\controllers
	 */
	class ApiController extends Controller
	{
		/**
		 * @return array
		 */
		public function behaviors ()
		{
			return [
				'tokenAuth'     =>  [
					'class'     =>  \conquer\oauth2\TokenAction::className(),
				],
			];
		}
		
		/**
		 * @param \yii\base\Action $action
		 * @return bool
		 */
		public function beforeAction ($action)
		{
			/**
			 *  bool 是否启用对此控制器中的操作的CSRF验证。
			 * 只有当此属性和[[\ yii \ web \ Request :: enableCsrfValidation]]都为真时，才启用CSRF验证。
			 * 关闭防跨站脚本攻击
			 */
			$this->enableCsrfValidation = false;
			\Yii::$app->response->format = Response::FORMAT_JSON;
			return parent::beforeAction($action);
		}
		
		public function actionIndex()
		{
			$user = \Yii::$app->user->identity;
			
			return [
				'username'  =>  $user->username,
				'email'     =>  $user->email,
			];
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	