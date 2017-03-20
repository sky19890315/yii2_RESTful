<?php

namespace backend\controllers;

class UserBackendController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
