<?php
	
	namespace api\modules\v1\controllers;
	
	use yii\rest\ActiveController;
	use yii\web\Response;
	
	/**
	 * Class BaseController
	 * @package api\modules\v1\controllers
	 * 作为统一的JSON格式父类
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
			return $behaviors;
		}
	}
		