<?php

namespace api\modules\v1\controllers;

use api\models\LoginForm;
use common\models\User;
use api\modules\v1\controllers\BaseController;
use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;

/**
 * Class UsersController
 * @package api\modules\v1\controllers
 */
class UsersController extends BaseController
{
	public $modelClass = 'api\models\Users';
	
	public function behaviors() {
		return ArrayHelper::merge (parent::behaviors(), [
			'authenticator' => [
				'class' => QueryParamAuth::className(),
				'tokenParam' => 'token',
				/**
				 * 以下选项为可选 即不会要求立刻验证
				 */
			'optional' => [
			'login',
			'signup-test'
			]
		]
		]);
	}
	
	/**
	 * @return array
	 */
	public function actionSignupTest ()
	{
		$user = new User();
		$user->generateAuthKey();
		$user->setPassword('123456');
		$user->username = '111';
		$user->email = '111@111.com';
		$user->save(false);
		
		return [
			'code' => 0
		];
	}
	
	/**
	 * @return array
	 */
	public function actionLogin ()
	{
		$model = new LoginForm;
		$model->setAttributes(Yii::$app->request->post());
		if ($user = $model->login()) {
			if ($user instanceof IdentityInterface) {
				return $user->api_token;
			} else {
				return $user->errors;
			}
		} else {
			return $model->errors;
		}
	}
	
	
}
