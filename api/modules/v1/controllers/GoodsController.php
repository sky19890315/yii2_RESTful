<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class GoodsController extends ActiveController
{
	public $modelClass = 'api\models\Goods';
	
	
	public function behaviors ()
	{
		$behaviors = parent::behaviors();
		$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
		return $behaviors;
		
		
		
	}
	
	
	
	
}
