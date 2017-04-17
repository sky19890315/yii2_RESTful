<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;


class AdminUserController extends Controller
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
	    
	    $model = new AdminUser();
	    
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
		
		if ($model->load(Yii::$app->request->post()) && $model->signup()) {
			return $this->redirect(['index']);
		}
		
		//渲染表单
		return $this->render('signup', ['model' => $model,]);
		
		/**
		 * Displays a single AdminUser model.
		 * @param integer $id
		 * @return mixed
		 */
	}
		public function actionView ($id)
		{
			return $this->render('view', ['model' => $this->findModel($id),]);
		}
		
		/**
		 * Creates a new AdminUser model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return mixed
		 */
		public function actionCreate ()
		{
			$model = new AdminUser();
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('create', ['model' => $model,]);
			}
		}
		
		/**
		 * Updates an existing AdminUser model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 * @param integer $id
		 * @return mixed
		 */
		public
		function actionUpdate ($id)
		{
			$model = $this->findModel($id);
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				return $this->render('update', ['model' => $model,]);
			}
		}
		
		/**
		 * Deletes an existing AdminUser model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 * @param integer $id
		 * @return mixed
		 */
		public
		function actionDelete ($id)
		{
			$this->findModel($id)->delete();
			return $this->redirect(['index']);
		}
		
		/**
		 * Finds the AdminUser model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 * @param integer $id
		 * @return AdminUser the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected
		function findModel ($id)
		{
			if (($model = AdminUser::findOne($id)) !== null) {
				return $model;
			} else {
				throw new NotFoundHttpException('The requested page does not exist.');
			}
		}
		
	
		
		
}



























