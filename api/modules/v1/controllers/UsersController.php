<?php

namespace api\modules\v1\controllers;

use Yii;
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
	
	/**
	 * @return array
	 */
	
	
	/**
	 * @return array
	 *
	 * 2017-04-18 判断 如果user实现了 IdentityInterface 的认证接口
	 * 则调用数据库中的api_token字段的值  否则错误
	 * 也就是登录时仅仅验证api_token
	 * 调用LoginForm的login方法
	 * 调用validate方法，随后对rules进行校验
	 * rules校验中调用validatePassword方法，对用户名和密码进行校验
	 * validatePassword方法校验的过程中调用LoginForm的getUser方法，通过common\models\User类的findByUsername获取用户，
	 * 找不到或者common\models\User的validatePassword对密码校验失败则返回error
	 * 触发LoginForm::GENERATE_API_TOKEN事件，调用LoginForm的onGenerateApiToken方法,
	 * 通过common\models\User的apiTokenIsValid校验token的有效性，如果无效，则调用User的generateApiToken方法重新生成
	 *
	 */

	
	
}
