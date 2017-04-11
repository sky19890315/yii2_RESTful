<?php

namespace api\controllers;

use Yii;
use api\models\Upload;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Class UploadController
 * @package api\controllers
 */
class UploadController extends Controller
{
	public $model = null;
	/**
	 * @return string
	 */
    public function actionIndex()
    {
        //
	    $model  = new Upload();
	
	    /**
	     * 判断文件传输格式
	     */
	    if (Yii::$app->request->isPost) {
		
		    $model->file = UploadedFile::getInstance($model, 'file');
		
		    /**
		     * 按日期排序 路径为 /var/www/workrest/advanced/api/web/uploads/2017xxxx/
		     * 如果考虑下载 可以实例化uploads路径 只要用户点击 就可以选择进入一个文件夹 即实例化路径
		     */
		    $path = 'uploads/' . date("Ymd", time()) . '/';
		    if ($model->file && $model->validate()) {
			    if (!is_dir($path)) {
				    mkdir($path, 0777);
			    }
			$filename = time() . '.' . $model->file->baseName . '.' . $model->file->extension;
			$filePath = $path . $filename;
			$model->file->saveAs($filePath);
			    /**
			     * 接收到数据的同时 写入数据库
			     */
			 Yii::$app->db->createCommand()->insert('filePath', [
				'fileName'  =>  $filename,
				'filePath'  =>  $filePath
			])->execute();
			
			
			    /**
			     * 文件上传 成功返回200 失败返回400
			     */
			  return \Yii::createObject([
			  	'class'     =>  'yii\web\Response',
				'format'    =>  \yii\web\Response::FORMAT_JSON,
				 'data'     =>  [
				 	'message'   =>  '文件上传成功！',
					 'code'     =>  '200',
				 ],
			  ]);
		    }
		
		    /**
		     * 文件上传 成功返回200 失败返回400
		     */
		    return \Yii::createObject([
			    'class'     =>  'yii\web\Response',
			    'format'    =>  \yii\web\Response::FORMAT_JSON,
			    'data'     =>  [
				    'message'   =>  '文件上传成功！',
				    'code'     =>  '200',
			    ],
		    ]);
	    }
	
	    \Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
	    return $this->renderPartial('index', ['model' => $model]);
    	//
    }
}
