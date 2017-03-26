<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;

/**
 * Class IndexController
 * @package backend\controllers
 */
class IndexController extends Controller
{
	/**
	 * @return string
	 * 做一个逻辑运算，判断用户状态：
	 * 0 未登录 -> 重定向去登录页面
	 * 1 已登录 -> 重定向到主页
	 * 2 没登录直接访问 抛出异常
	 *
	 */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionLogin()
    {
    	//判断是否通过认证
	    //已通过认证直接去后台首页
	    //不是guest就意味着是已经认证的用户
	    if (!\Yii::$app->user->isGuest){
	    	//去往首页
		    return $this->goHome();
	    }
	    
	    //否则就是没有登录，调用登录页面
	    $model = new LoginForm();
	    
	    //接收表单数据病调用登录方法（行为）
	    //只接收post方式的表单 并且调用模型中的登录方法
	    if ($model->load(\Yii::$app->request->post()) && $model->login()) {
	    	return $this->goBack();
	    }else{
	    	//弹出表单给用户登录
		    return $this->renderPartial('login', [
		    	'model' =>  $model,
		    ]);
	    }
	    
    }
    
    
    

}
