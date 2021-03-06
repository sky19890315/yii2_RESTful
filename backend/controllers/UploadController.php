<?php
	/**
	 * Created by PhpStorm.
	 * User: s
	 * Date: 17-3-28
	 * Time: 上午11:33
	 */
	namespace backend\controllers;
	
	use backend\models\Upload;
	use Yii;
	use yii\web\Controller;
	use yii\web\UploadedFile;
	
	class UploadController extends Controller
	{
		/**
		 * @return string
		 */
		public function actionIndex ()
		{
			return $this->renderPartial('index');
		}
		
		/**
		 * @return string|\yii\web\Response
		 * 文件上传控制器
		 */
		public function actionUpload ()
		{
			$model = new Upload();
			
			
			//判断是否是post传输
			if (Yii::$app->request->isPost) {
				/*
				 *返回给定模型属性的上传文件。
				应该使用[[\ yii \ widgets \ ActiveField :: fileInput（）]]上传文件。
                @param \ yii \ base \ Model $模型的数据模型
                @param string $属性名称。 属性名称可能包含数组索引。
				例如，'[1]文件'表格文件上传; 和'file [1]'用于文件数组中的一个元素。
				@return已上传文件上传文件的实例。
                如果没有为指定的模型属性上传文件，则返回空值。
				@see getInstanceByName（）
				 * */
				$model->file = UploadedFile::getInstance($model, 'file');
				
				
				$path = 'uploads/' . date("Ymd", time()) . '/';
				if ($model->file && $model->validate()) {
					if (!is_dir($path)) {
						mkdir($path, 0777);
					}
					
					$model->file->saveAs($path . time() . '.' . $model->file->baseName . '.' . $model->file->extension);
					
					Yii::$app->session->setFlash('success', '文件上传成功！');
					return $this->redirect('upload');
				}
				
			}
			return $this->render('upload', ['model' => $model]);
			
			
		}
		
	}