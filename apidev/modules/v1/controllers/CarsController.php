<?php

namespace apidev\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class CarsController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    public $modelClass = 'api\models\Cars';
    
    
    
    
}
