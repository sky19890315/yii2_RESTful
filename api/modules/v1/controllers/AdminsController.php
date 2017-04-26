<?php

namespace api\modules\v1\controllers;

use api\modules\v1\controllers\BaseController;

/**
 * Class AdminsController
 * @package api\modules\v1\controllers
 * 列出在models中制定的资源
 * 管理员用户不允许被删除 所以加上禁止删除的动作
 * 也不允许修改
 * @author  sunkeyi
 * @time 2017 04 24
 */
class AdminsController extends BaseController
{
	public $modelClass = 'api\models\Admin';
	
	/**
	 * @return null
	 */
	/*public function actions ()
	{
		$actions = parent::actions(); //
		
		unset($actions['delete'], $actions['put']);
	}*/
	
	/*
	 * 执行操作前应该先检查appid
	 * 只有指定的超级管理员才能进行曾删改的动作
	 * 只有appid对应的是超级管理员 才能进行删除和更新操作
	 * 其它用户只能get到特定的信息 就是那么拽
	 */
	
	/*
	public function  checkAccess ($action, $model = null, $params = [])
	{
		
		  选择特性的动作 如果是这些动作 就要去查找用户的appid
		 这里用到C语言的一些语法
		 
		
		if ($action === 'update' || $action === 'delete') {
			if ($model->appid !== '54r102937178p103') {
				throw new \yii\web\ForbiddenHttpException(
					sprintf('你没有 %s 的权限，请联系管理员 ',$action)
				);
			}
		}
		
		
		
	}
	*/
	
}
