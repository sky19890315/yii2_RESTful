<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class CarsController extends ActiveController
{
    public $modelClass = 'api\models\Cars';

}
