<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Class RbacController
 * @package backend\controllers
 */
class RbacController extends Controller
{
	public function behaviors()
	{
		//修复无法登录的问题 ↓ 已可以正常登录
		return ['access' => ['class' => AccessControl::className(), 'only' => ['login', 'logout', 'index', 'upload'], 'rules' => [['allow'   => true, /**
		 * 规格对以下列出的动作有效
		 * 设置角色 @ --表示当前规则针对认证过的用户
		 * ？ --表示所有用户均可访问
		 */
		                                                                                                                           'actions' => ['login'], 'roles' => ['?'],], /**
		 * 只有已经登录的用户才能退出
		 */
			['actions' => ['logout', 'upload', 'index'], 'allow' => true, //角色
			 'roles'   => ['@'],],],], //access结束
		];
	}
	
	public function actionIndex()
	{
		return $this->render('index');
	}
}
















