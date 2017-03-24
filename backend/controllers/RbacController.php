<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;


class RbacController extends Controller
{
  //初始化方法 测试用例
	public function actionInit()
	{
		$auth = Yii::$app->authManager;
		//添加  /blog/index 权限
		$blogIndex = $auth->createPermission('/blog/index');
		$blogIndex->description = '获取博客列表';
		$auth->add($blogIndex);
		//创建一个blogindex角色并为其赋值
		//$blogManage = $auth->createRole('博客管理');
		//$auth->add($blogManage);
		//$auth->addChild($blogManage, $blogIndex);
		
		//假设有一个用户test1 他的uid是1
		//为该uid赋值
		//$auth->assign($blogManage, 1);
	}
  
    public function actionInit2()
    {
    	$auth = Yii::$app->authManager;
    	
    	//添加权限
	    //看
	    $blogView = $auth->createPermission('/blog/view');
	    $auth->add($blogView);
	    //增
	    $blogCreate = $auth->createPermission('/blog/create');
	    $auth->add($blogCreate);
	    //更新
	    $blogUpdate = $auth->createPermission('/blog/update');
	    $auth->add($blogUpdate);
	    //删除
	    $blogDelete = $auth->createPermission('/blog/delete');
	    $auth->add($blogDelete);
	    
	    //分配权限
	    $blogManage = $auth->getRole('博客管理');
	    $auth->addChild($blogManage, $blogView);
	    $auth->addChild($blogManage, $blogCreate);
	    $auth->addChild($blogManage, $blogUpdate);
	    $auth->addChild($blogManage, $blogDelete);
	    
    }
    
  
  
  

}
















