<?php
	/**
	 * Created by PhpStorm.
	 * User: s
	 * Date: 17-3-28
	 * Time: 上午10:38
	 */
	namespace backend\models;
	
	use yii\base\Model;
	use yii\web\UploadedFile;
	
	/**
	 * Class UploadForm
	 * @package backend\models
	 */
	class UploadForm extends Model
	{
		public $imageFile;
		
		/**
		 * 验证规则
		 * @return array
		 */
		public function rules ()
		{
			return [[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png', 'jpg'],];
		}
		
		/**
		 *
		 */
		public function upload ()
		{
			$file = new UploadedFile();
			
			if ($this->validate()){
				$this->imageFile->saveAs('uploads/'. $this->imageFile->baseName. '.'.$this->imageFile->extension);
				return true;
			}else{
				return false;
			}
			
			
		}
	}