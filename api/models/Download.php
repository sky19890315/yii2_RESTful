<?php
	namespace api\models;
	
	use yii\base\Model;
	
	class Download extends Model
	{
		/**
		 * @var 属性
		 */
		public $file;
		
		/**
		 * @return array
		 * 验证规则
		 */
		public function rules ()
		{
			return [
				[['file'], 'file', 'extensions' => 'jpg, png, jpeg', 'mimeTypes' => 'image/jpeg, image/png'],
			];
		}
	
	}