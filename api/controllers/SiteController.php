<?php
namespace api\controllers;

/**
 * ━━━━━━神兽出没━━━━━━
 * 　　　┏┓　　　┏┓
 * 　　┏┛┻━━━┛┻┓
 * 　　┃　　　　　　　┃
 * 　　┃　　　━　　　┃
 * 　　┃　┳┛　┗┳　┃
 * 　　┃　　　　　　　┃
 * 　　┃　　　┻　　　┃
 * 　　┃　　　　　　　┃
 * 　　┗━┓　　　┏━┛
 * 　　　　┃　　　┃  神兽保佑
 * 　　　　┃　　　┃  代码无bug　　
 * 　　　　┃　　　┗━━━┓
 * 　　　　┃　　　　　　　┣┓
 * 　　　　┃　　　　　　　┏┛
 * 　　　　┗┓┓┏━┳┓┏┛
 * 　　　　　┃┫┫　┃┫┫
 * 　　　　　┗┻┛　┗┻┛
 * ━━━━━━感觉萌萌哒━━━━━━
 */

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\auth\QueryParamAuth;
use common\models\User;
use yii\web\Response;
use backend\models\UserSignupForm;

/**
 * 2017-04-14 增加登录等功能 尽情debug把骚年
 * Site controller
 */
class SiteController extends Controller
{
	/**
     * 2017-04-14 增加登录等功能 尽情debug把骚年
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
        \Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->renderPartial('index');
        
    }
	
	/**
	 * @return string|Response
	 * 自动登录页面
	 */
	public function actionLogin()
	{
		if (!Yii::$app->user->isGuest) {
			 return $this->goHome();
		}
		
		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			
			\Yii::$app->response->format = Response::FORMAT_HTML;
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}
	
	public function actionSignup()
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
		\Yii::$app->response->format = Response::FORMAT_HTML;
		return $this->render('signup', ['model' => $model,]);
	}
	    

    	
    
   
	
	
}
