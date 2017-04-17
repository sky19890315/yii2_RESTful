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
        \Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        return $this->renderPartial('index');
        
    }
	
   
	    
	public function actionTest()
	{
		$user = new User();
		$user->generateApiToken();
		$user->generateAuthKey();
		$user->username = 'test2017';
		$user->setPassword('123456');
		$user->email = '2017@qq.com';
		$user->created_at = '20170101';
		$user->updated_at = '20170101';
		$user->save(false);
		
		return [
			'code' => 0,
		];
	}
    	
    
   
	
	
}
