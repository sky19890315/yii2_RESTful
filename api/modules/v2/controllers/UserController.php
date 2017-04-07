<?php

namespace api\modules\v2\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Class UserController
 * @package api\modules\v2\controllers
 */
class UserController extends ActiveController
{
	/**
	 * @return array
	 * 响应格式改为JSON格式
	 */
	public function behaviors ()
	{
		$behaviors = parent::behaviors();
		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
		return $behaviors;
	}
	
	
	//响应restful
	public $modelClass = 'api\models\User';
}
