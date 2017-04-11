<?php

namespace api\modules\v1\controllers;

use api\models\LoginForm;
use common\models\User;
use yii\filters\auth\QueryParamAuth;
use api\modules\v1\controllers\BaseController;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * 测试用例
 * Class UserauthController
 * @package api\modules\v1\controllers
 * 1、调用LoginForm的login方法
 * 2、调用validate方法，随后对rules进行校验
 * 3、rules校验中调用validatePassword方法，对用户名和密码进行校验
 * 4、validatePassword方法校验的过程中调用LoginForm的getUser方法，
 * 通过common\models\User类的findByUsername获取用户，找不到或者common\models\User的validatePassword对密码校验失败则返回error
 * 5、触发LoginForm::GENERATE_API_TOKEN事件，调用LoginForm的onGenerateApiToken方法,
 * 通过common\models\User的apiTokenIsValid校验token的有效性，如果无效，则调用User的generateApiToken方法重新生成
 *
 */
class UserauthController extends BaseController
{
	/**
	 * @return array
	 * 合并数组
	 */
    public function behaviors ()
    {
    	return ArrayHelper::merge( parent::behaviors(), [
    		'authenticator'     =>  [
    			'calss'         =>  QueryParamAuth::className(),
			
			    /**
			     * 增加token参数 不稳定因素
			     */
			
			 'tokenParam'    =>  'token',
			    
			    /**
			     * 可选项操作 用于测试用例
			     */
			    'optional'      =>  [
			        'login',
				    'signup-test',
			    ],
		    ],
	    ]);
    }
	
	/**
	 * 测试首页
	 */
	
	public function actionIndex()
	{
		//$this->renderPartial('index');
		echo "hello";
	}
	
	
	
	/**
	 * 测试用例的目的是通过服务器访问这个控制器中的signuptest动作后
	 * 会调用user的类 生成相应的用户数据 用于访问
	 * @return array
	 */
    public function actionSignupTest()
    {
	    /**
	     * 实例化user类之后 ，调用里面的方法
	     * 并写入测试数据
	     */
    	$user = new User();
	    /**
	     * 自动生成认证密钥
	     */
    	$user->generateAuthKey();
    	$user->username = 'testauth';
    	$user->setPassword('123456');
    	$user->email = '222222@qq.com';
    	$user->generateApiToken();
	    /**
	     * 避免重复返回错误信息
	     */
    	$user->save(false);
    	
    	return [
    	    'code'  =>  0
	    ];
    	
    }
	
	/**
	 * 调用登录的方法
	 * @return array\
	 */
    public function actionLogin()
    {
    	$model = new LoginForm();
    	$model->setAttributes(\Yii::$app->request->post());
    	
    	if ( $user = $model->login()) {
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
