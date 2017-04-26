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
use yii\filters\AccessControl;


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
	 * @return array
	 * 这个行为的作用是自动更新创建时间和更新时间
	 * 因为我们要创建用户 当然不希望每个值都填充
	 * 在插入数据库之前创建时间 更新时间
	 * 在插入数据库之后更新时间
	 * 当记录插入时， 行为将当前的 UNIX 时间戳赋值给 created_at 和 updated_at 属性；
	 * 当记录更新时，行为将当前的 UNIX 时间戳赋值给 updated_at 属性。
	 */
	/**
	 * @inheritdoc
	 *
	 * 对行为进行过滤 对于删除用户的方法 只允许使用 post 提交 以避免误删
	 * 增加普通用户访问权限 普通用户 没有登录 是无法访问以下的动作的
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
					'create, update, delete' => ['POST'],
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
		
		/**
		 * 读取默认值
		 * 你的表列也许定义了默认值。有时候，你可能需要在使用web表单的时候给AR预设一些值。
		 * 如果你需要这样做，可以在显示表单内容前通过调用loadDefaultValues()方法来实现：
		 */
		$model->loadDefaultValues();
		
		
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('create', [
				'model'     => $model,
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
	
	
	
	

