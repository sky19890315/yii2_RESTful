<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;

//用于测试账号
use common\models\User;

//调用登录操作
use api\models\LoginForm;
use yii\web\IdentityInterface;

/**
 * Class UserController
 * @package api\modules\v1\controllers
 */
class UserController extends ActiveController
{
	//显示正常的restfulAPI
	/**
	 * @var string
	 */
	public $modelClass = 'api\models\User';
	
	//设置过滤行为 yii中的方法称为行为
	public function behaviors ()
	{
		return ArrayHelper::merge(
			//启用父行为
			parent::behaviors(), [
		//做认证
			'authenticator'     =>  [
				//调用认证类
				'class' =>  QueryParamAuth::className(),
				//修改默认的token
				'tokenParam'    =>  'token',
				//解决第一次登录时无token的问题
				'optional'  => [
					'login',
					'signup-test',
				],
			]
		
		]);
	}
	
	//实现认证方法
	/**
	 * @param      $token
	 * @param null $type
	 * @return mixed
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne(['access_token'  =>  $token, 'status' => self::STATUS_ACTIVE]);
	}
	
	//写入测试账号
	/**
	 * @return array
	 */
	public function actionSignupTest()
	{
		$user = new User();
		$user->generateAuthKey();
		$user->setPassword('123456');
		$user->username = 'test';
		$user->email = '123456@qq.com';
		//避免重复调用验证
		$user->save(false);
		
		return [
			'code'  =>  0
		];
	}
	
	//登录操作
	/**
	 * @return mixed
	 */
	public function actionLogin()
	{
		$model = new LoginForm();
		//请求只允许post方法
		$model->setAttributes(\Yii::$app->request->post());
		if ($user = $model->login()){
			//判断是否是实例化
			if ($user instanceof IdentityInterface){
				return $user->api_token;
			}else{
				return $model->errors;
			}
		}else{
			return $model->errors;
		}
		
	}
	
/*	public function findIdentityByAccessToken($token, $type = null)
	{
		//token无效直接抛出异常
		if (!static::apiTokenIsValid($token)){
			throw new \Yii\web\UnauthorizedHttpException('该 token 无效');
		}
	}*/
	
	/**
	 * 获取用户信息
	 * @param $token
	 * @return array
	 *  到这一步，token都认为是有效的了，下面只需要实现业务逻辑即可，
	 * 下面仅仅作为案例，比如你可能需要关联其他表获取用户信息等等
	 *
	 */
	public function actionUserProfile($token)
	{
		$user = User::findIdentityByAccessToken($token);
		
		return [
			'id'        =>      $user->id,
			'username'  =>      $user->username,
			'email'     =>      $user->email,
		];
	}



}
