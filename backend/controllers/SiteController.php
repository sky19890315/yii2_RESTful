<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
			    //验证规则1 做登录验证
			    //当前规则将会针对这里设置的actions起作用，如果actions不设置
			    //默认就是当前控制器的所有动作
			    'rules'     =>  [
			    	[
			    //actions和allow就是 AccessRule的属性
				//20170324增加验证规则 index view create update delete signup  ---sky
			    //'actions' =>  ['login', 'error'],  20170324 --sky 替代如下
				/*注意 -- 修改规则后导致无法登录。即无法访问登录页面 故增加login和 error路由*/
				'actions'   =>  ['index', 'view', 'create', 'update', 'create', 'signup', 'login', 'error'],
				//符合以上规则允许访问
			    'allow'     =>  true,
				//设置角色 @ --表示当前规则针对认证过的用户	 ？ --表示所有用户均可访问
		            ],
			    //验证规则2 做退出登录
				    [
				'actions'   =>  ['logout', 'index'],
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
		    ];
	    
	    //修复无法登录的问题↑
    	
    	
    	
    	
    	//后期增加路由控制需要的部分 可以先注释掉
	    /*
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
	                    // 当前rule将会针对这里设置的actions起作用，如果actions不设置，默认就是当前控制器的所有操作
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'signup'],
	                    // 设置actions的操作是允许访问还是拒绝访问
                        'allow' => true,
	                    // @ 当前规则针对认证过的用户; ? 所有方可均可访问
	                    'roles' => ['@'],
                    ],
						//修改认证方式 20170322
                    [
                        'actions' => ['index'],
                        'allow' => true,
	                    //允许操作的action 动词 POST
                        'verbs' => ['POST'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
        */
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
        	
        	//已经登录用户直接调用登录表单
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
}
