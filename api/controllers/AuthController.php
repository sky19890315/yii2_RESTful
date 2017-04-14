<?php
	/**
	 * Created by PhpStorm.
	 * User: s
	 * Date: 17-4-14
	 * Time: 上午9:23
	 */
	namespace api\controllers;
	
	use common\models\LoginForm;
	use yii\web\Controller;
	
	/**
	 * Class AuthController
	 * @package api\controllers
	 */
	class AuthController extends Controller
	{
		/**
		 * @return array
		 */
		public function behaviors ()
		{
			return [
				/**
				 * 如果用户已经登录 则检查其认证证书
				 */
				'oauth2Auth'    =>  [
					
					/**
					 * 返回此类的完全限定名称。
					 */
					'class'     =>  \conquer\oauth2\AuthorizeFilter::className(),
					'only'      =>  ['index'],
				],
			];
		}
		
		/**
		 * @return array
		 */
		public function actions ()
		{
			return [
				'token'     =>  [
					'class' =>  \conquer\oauth2\TokenAction::className(),
				],
			];
		}
		
		public function actionIndex()
		{
			$model = new LoginForm();
			
			if ($model->load(\Yii::$app->request->post()) && $model->login()) {
				return $this->goBack();
			} else {
				return $this->render('index', ['model' => $model,
				]);
			}
			
			
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	