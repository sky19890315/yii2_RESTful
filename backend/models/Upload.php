<?php
	/**
	 * Created by PhpStorm.
	 * User: s
	 * Date: 17-3-28
	 * Time: 下午12:23
	 */
	namespace backend\models;
	
	use Yii;
	use yii\base\Model;
	
	class Upload extends Model
	{
		/**
		 * @var attribute
		 */
		public $file;
		
		/**
		 * @return array
		 */
		public function rules ()
		{
			return [
				[['file'], 'file', 'extensions' => 'jpg, png, jpeg', 'mimeTypes' => 'image/jpeg, image/png'],
			];
		}
		
	}
	