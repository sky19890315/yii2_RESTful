<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Class UsersController
 * @package api\modules\v1\controllers
 */
class UsersController extends ActiveController
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
	
	public $modelClass = 'api\models\User';
	
}
