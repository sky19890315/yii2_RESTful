<?php
	namespace console\controllers;
	
	use Yii;
	use yii\console\Controller;
	
	class RbacController extends Controller
	{
		public function actionInit()
		{
			$auth = Yii::$app->authManager;
			
			// 添加 "createPost" 权限
			$createPost = $auth->createPermission('创建文章');
			$createPost->description = '创建一篇文章';
			$auth->add($createPost);
			
			// 添加 "updatePost" 权限
			$updatePost = $auth->createPermission('更新文章');
			$updatePost->description = '更新一篇文章';
			$auth->add($updatePost);
			
			// 添加 "author" 角色并赋予 "createPost" 权限
			$author = $auth->createRole('作者');
			$auth->add($author);
			$auth->addChild($author, $createPost);
			
			// 添加 "admin" 角色并赋予 "updatePost"
			// 和 "author" 权限
			$admin = $auth->createRole('管理员');
			$auth->add($admin);
			$auth->addChild($admin, $updatePost);
			$auth->addChild($admin, $author);
			
			// 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id （译者注：user表的id）
			// 通常在你的 User 模型中实现这个函数。
			$auth->assign($author, 2);
			$auth->assign($admin, 1);
		}
	}