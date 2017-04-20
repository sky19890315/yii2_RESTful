<?php

namespace backend\controllers;

//
//   █████▒█    ██  ▄████▄   ██ ▄█▀       ██████╗ ██╗   ██╗ ██████╗
// ▓██   ▒ ██  ▓██▒▒██▀ ▀█   ██▄█▒        ██╔══██╗██║   ██║██╔════╝
// ▒████ ░▓██  ▒██░▒▓█    ▄ ▓███▄░        ██████╔╝██║   ██║██║  ███╗
// ░▓█▒  ░▓▓█  ░██░▒▓▓▄ ▄██▒▓██ █▄        ██╔══██╗██║   ██║██║   ██║
// ░▒█░   ▒▒█████▓ ▒ ▓███▀ ░▒██▒ █▄       ██████╔╝╚██████╔╝╚██████╔╝
//  ▒ ░   ░▒▓▒ ▒ ▒ ░ ░▒ ▒  ░▒ ▒▒ ▓▒       ╚═════╝  ╚═════╝  ╚═════╝
//  ░     ░░▒░ ░ ░   ░  ▒   ░ ░▒ ▒░
//  ░ ░    ░░░ ░ ░ ░        ░ ░░ ░
//           ░     ░ ░      ░  ░
//


use Yii;
use yii\web\Controller;
use backend\models\User;
use yii\data\ActiveDataProvider;
use backend\models\UserSignupForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * 为了实现添加授权用户
 * 在这个类中 只条用添加用户的方法
 * 其它方法不用实现 因为只有登录后台的用户才可以添加api请求用户
 * 这就符合了逻辑要求
 * 即api只有有权限登录后台的用户 才能去添加
 * Class UserController
 * @package backend\controllers
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
	
	/**
	 * @inheritdoc
	 *
	 * 对行为进行过滤 对于删除用户的方法 只允许使用 post 提交 以避免误删
	 * 叶
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
				],
			],
		];
	}
	
	/**
	 * @return string
	 */
	public function actionIndex()
	{
		/**
		 * 实例化用户模型 以得到数据
		 * 不是登录表单
		 * 通过这个User对象 得到值并pass到视图文件
		 * User类和AdminUser类是对应关系的
		 */
		$model = new User();
		$dataProvider =new ActiveDataProvider([
			'query' => User::find(),
			'pagination'    =>  [
				'pagesize'  =>  '10',
			]
		]);
		
		return $this->render('index', ['model' => $model, 'dataProvider' => $dataProvider]);
	}
	
	/**
	 * @return string|\yii\web\Response
	 * 如果是已登录用户 则不再调用登录的方法 否则调用登录的方法
	 */
	public function actionSignup ()
	{
		$model = new UserSignupForm();
		if ($model->load(Yii::$app->request->post())) {
			if ($user = $model->signup()) {
				if (Yii::$app->getUser()->login($user)) {
					return $this->goHome();
				}
			}
		}
		
		//调用登录视图
		$this->layout = 'main-signup-user';
		return $this->render('signup', ['model' => $model,]);
		
	}
	
	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}
	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new User();
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}
	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		/**
		 * 为update和create场景 添加自动输入
		 */
		
		
		
		$model = $this->findModel($id);
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}
	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}
	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
	
	
	
	

