<?php

namespace api\controllers;

class UploadController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

}
