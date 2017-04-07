<?php

namespace api\controllers;

class FileController extends \yii\web\Controller
{
	public $model = null;
    public function actionIndex()
    {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('index');
    }

}
