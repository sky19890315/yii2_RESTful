<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminUser;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use backend\models\SignupForm;
use backend\models\AdminUserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Class AdminUserController
 * @package backend\controllers
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends Controller
{
	/**
	 * 首先定义了相关的动作 即删除指定post方式才能访问
	 * 其实创建用户 应该也规定只能使用post方式
	 */
	public function behaviors()
	{
		return [
			
			/*
			 * 根据这个特色来设置的 即应该所有的管理员控制动作
			 * 都需要已经登录的用户才可以进行设置
			 * 未登录用户绝对不能对这个进行操作
			 */
			
			
			
			'access'        =>  [
				'class'     =>  AccessControl::className(),
				'only'  =>  ['index', 'create','update','delete', 'view'],
				'rules'     =>  [
				
					/**
					 * 只有已经登录的用户才能退出
					 */
					[
						'actions'   =>  ['index', 'create','update','delete', 'view'],
						'allow'     =>  true,
						//角色
						'roles'     =>  ['@'],
					],
				],
			], //access结束
			
			
			
			
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete, create, update' => ['POST'],
				],
			],
		];
	}
	
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
	    
	    $searchModel = new AdminUserSearch();
	    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	    return $this->render('index', [
		    'searchModel' => $searchModel,
		    'dataProvider' => $dataProvider,
	    ]);
	    
    }
	
	/**
	 * @param $id
	 * @return string
	 */
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
				return $this->render('create', ['model' => $model]);
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



























