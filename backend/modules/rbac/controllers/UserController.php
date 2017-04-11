<?php

namespace backend\modules\rbac\controllers;

use backend\modules\rbac\controllers\BaseController;
use backend\modules\rbac\models\User;
use backend\services\UrlService;

/**
 * Class UserController
 * @package backend\modules\rbac\controllers
 */
class UserController extends BaseController
{
	/**
	 * 伪造登录信息
	 * @return \yii\web\Response
	 */
	public function actionVlogin()
	{
		$uid = $this->get('uid', 0);
		/**
		 * 统一回调url
		 */
		$rebackUrl = UrlService::buildUrl('rbac/index');
		
		
		if (!$uid) {
			return $this->redirect($rebackUrl);
		}
		
		$user_info = User::find()->where([ 'id' => $uid ])->one();
		
		if (!$user_info) {
			return $this->redirect($rebackUrl);
		}
		
		/**
		 * 因为通过cookie保存用户信息 所以需要加密
		 * 规则： user_auth_token + # + uid
		 */
		$user_auth_token = md5( $user_info['id'].$user_info['name'].$user_info['email'].$_SERVER['HTTP_USER_AGENT']);
		
		$cookie_target = \Yii::$app->response->cookies;
		$cookie_target->add(new \Yii\web\Cookie([
			
			'name'      => 'imguowei_888',
			'value'     =>  $user_auth_token . '#' .$user_info['id']
			
		]));
		
		return $this->redirect($rebackUrl);
	}
}
