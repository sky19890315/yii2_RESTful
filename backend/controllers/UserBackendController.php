<?php

namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\UserBackend;


class UserBackendController extends \yii\web\Controller
{
	
	/**
	 * @return string
	 *
	 * 由于直接通过gii生成的控制器，
	 * 实际上应该是分页显示的
	 * 结果导致没有分页，所以手动加上分页显示
	 * 就是如下
	 */
    public function actionIndex()
    {
	    //实例化
	    $model = new UserBackend();
	    $dataProvider =new ActiveDataProvider([
		    'query'         => $model->find(),
		    'pagination'    =>  [
			    'pagesize'  =>  '10',
		    ]
	    ]);
		
	    return $this->render('index', ['model' => $model, 'dataProvider' => $dataProvider]);
    }
	
    //创建新用户
	public function actionSignup()
	{
		
		$model = new \backend\models\SignupForm();
		
		//判断是否是post提交且数据验证成功
		// $model->load() 方法，实质是把post过来的数据赋值给model
		// $model->signup() 方法, 是我们要实现的具体的添加用户操作
		
		if ($model->load(Yii::$app->request->post()) && $model->signup()){
			return $this->redirect(['index']);
		}
		
		//渲染表单
		return $this->render('signup', [
			'model' => $model,
		]);
	}
	
}



























