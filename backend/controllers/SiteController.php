<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use backend\models\SignupForm;

/**
 * Site controller
 * 首先这个是默认首页
 * 所有用户登录back.com 都会导向他们来到site/index页面
 * 第二 ？ 表示未登录用户 即游客用户可访问  已登录用户无法访问
 * 这是基于AFC的访问控制 比较简单粗暴
 * 第三 @ 表示已登录用户可以访问  未登录用户无法访问  这个可以做一些简单的用户判断
 * 总不能未登录用户就能访问了把
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
			    'only'  =>  ['login', 'logout','index', 'upload'],
			    'rules'     =>  [
			    	[
			    'allow'     =>  true,
					    /**
					     * 规格对以下列出的动作有效
					     * 设置角色 @ --表示当前规则针对认证过的用户
					     * ？ --表示所有用户均可访问
					     */
				'actions'   =>  ['login'],
				'roles' =>  ['?'],
		            ],
				    /**
				     * 只有已经登录的用户才能退出
				     */
				    [
				'actions'   =>  ['logout', 'upload', 'index'],
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
		
        /*
         * 因为前后端共用登录表单会导致一些莫名的bug
         * 比如无法登录等  故将前后端登录表单进行分离验证
         */
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
    	/*
    	 * 调用后端登录表单实现登录
    	 */
    	$model = new SignupForm();
	    /**
	     * 如果是已经登录的用户直接去首页
	     * 删除登录的方法 注册完成直接去首页
	     */
	    
    	if ($model->load(Yii::$app->request->post()) && $model->signup()) {
    		return $this->redirect('index');
	    }
	    
	    $this->layout = 'main-signup';
	    return $this->render('signup', ['model'  => $model]);
	    
    }
    
    
    
}
