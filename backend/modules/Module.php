<?php

namespace backend\modules;

/**
 * module module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		
        //调用子类模块
		$this->modules = [
			//模块1 测试博客
			'blog' => [
				'class' => 'backend\modules\blog\Blog',
			],
			
			//用户登录模块
			'login' => [
				'class' => 'backend\modules\login\Login',
			],
			
			//用户认证模块
			'auth' => [
				'class' => 'backend\modules\auth\Auth',
			],
			
			//权限管理模块
			'rbac' => [
				'class' => 'backend\modules\rbac\Rbac',
			],
		];
	    
    }
}
