<?php

namespace api\modules\v1\controllers;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
