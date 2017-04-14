<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
	
	
    /**
     * Displays homepage.
     *  设置首页响应格式，避免出现混乱
     * @return mixed
     */
    public function actionIndex()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('index');
        
    }
	
    public function actionLogin()
    {
	    \Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
    	/**
	     * 2017-04-12 判断用户是否是认证用户
	     * 1 是认证用户 允许访问后续的页面
	     * 2 不是认证用户 返回一组json  不接受跳转去登录页面
	     */
	    $model = new LoginForm();
	        return $this->render('login', ['model' => $model]);
    		
	    }
    	
    
   
	
	
}
