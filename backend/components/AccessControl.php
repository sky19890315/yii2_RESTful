<?php
	namespace backend\components;
	
	use Yii;
	use yii\web\ForbiddenHttpException;
	use yii\base\ActionFilter;
	
	/**
	 * Class AccessControl
	 * @package backend\components
	 * 用布尔值判断结果，返回true则有访问权限
	 */
	class AccessControl extends ActionFilter
	{
		
		public function beforeAction ($action)
		{
			//获取当前路由
			$actionId = $action->getUniqueId();
			$actionId = '/'. $actionId;
			
			//当前登录用户的id
			$user    = Yii::$app->getUser();
			$userId  = $user->id;
			
			//获取当前用户已经分配过的路由权限
			$routes = [];
			$manager = Yii::$app->getAuthManager();
			
			//遍历
			foreach ($manager->getPermissionsByUser($userId) as $name => $value){
				
				if ($name[0] === '/'){
					$routes[] = $name;
				}
			}//end of foreach
			
			//判断当前用户是否有权限访问正在请求的路由
			if (in_array($actionId, $routes)){
				return true;
			}
			
			//否则拒绝访问
			$this->denyAccess($user);
		}
		
		protected function denyAccess($user)
		{
			if ($user->getIsGuest()){
				$this->loginRequired();
				
			}else{
				throw new ForbiddenHttpException('不允许访问。');
			}
			
		}
		
		
	}
	