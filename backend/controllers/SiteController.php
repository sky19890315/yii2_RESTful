<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\SignupForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
    	//修复无法登录的问题 ↓ 已可以正常登录
	    return [
	    	'access'        =>  [
	    	    'class'     =>  AccessControl::className(),
			    'only'  =>  ['login', 'logout', 'signup','index'],
			    'rules'     =>  [
			    	[
			    'allow'     =>  true,
					    /**
					     * 规格对以下列出的动作有效
					     * 设置角色 @ --表示当前规则针对认证过的用户
					     * ？ --表示所有用户均可访问
					     */
				'actions'   =>  ['login', 'signup'],
				'roles' =>  ['?'],
		            ],
				    /**
				     * 只有已经登录的用户才能退出
				     */
				    [
				'actions'   =>  ['logout','index'],
				'allow'     =>  true,
				//角色
				'roles'     =>  ['@'],
				    ],
			    ],
	    ], //access结束
		    //动词
		    'verbs'         =>  [
		        'class'     =>  VerbFilter::className(),
			    'actions'   =>  [
			    'logout'    =>  ['post'],
			    ],
		    ],
		    
	    
	    //修复无法登录的问题↑
	    
	    /**
	     * 日期 2017-04-14 增加首页缓存机制 在一定时间内访问后台首页 将调用本地缓存文件
	     *  @param Action $action 当前处理的动作对象
	     *  @param array $params “params” 属性的值
	     *  @return int 页面修改时的 Unix 时间戳
	     * 上述代码表明 HTTP 缓存只在 index 动作时启用。
	     */
	    /*
	    [
	    	'class'         =>  'yii\filters\HttpCache',
		    'only'          =>  'index',
		    'lastModified'  =>  function ($action, $params) {
	    	    $q = new \yii\db\Query();
	    	    return $q->from('post')->max('update_at');
		    }
	    ],
	*/
	    ]; //end of return
	    
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	
    	return $this->render('index');
    }
	
	/**
	 * 登录操作
	 * 点击后台后调用site控制器的login方法
	 * @return string|\yii\web\Response
	 *
	 */
    public function actionLogin()
    {
    	//判断是否是认证用户
        if (!Yii::$app->user->isGuest) {
        	//直接去后台
            return $this->goHome();
        }
		
        //调用前段登录模型
        $model = new LoginForm();
        
        //接收表单数据并调用登录方法
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
	
	        /**
	         * 未登录用户调用登录表单
	         * Do not use this code in your template. Remove it.
	         * Instead, use the code  $this->layout = '//main-login'; in your controller.
	         */
	        
	        $this->layout = 'main-login';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	/**
	 * @return string
	 */
    public function actionSignup()
    {
    	$model = new SignupForm();
	    /**
	     * 如果是已经登录的用户直接去首页
	     * 否则清登录页面
	     */
	    /*
    	if ($model->load(Yii::$app->request->post())) {
    		if ($user = $model->signup()) {
    			if (Yii::$app->getUser()->login($user)) {
    				return $this->goHome();
			    }
		    }
	    }
	    */
	    $this->layout = 'main-login';
	    return $this->render('signup', ['model'  => $model]);
	    
    }
    
    
    
}
