<?php
	namespace backend\components;
	
	use Yii;
	
	class MyBehavior extends \yii\base\ActionFilter
	{
		public function beforeAction ($action)
		{
			var_dump(222222);
			return true;
		}
	}