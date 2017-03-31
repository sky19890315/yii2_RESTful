<?php

namespace api\modules\v1\upload\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\UploadedFile;
use api\models\Upload;

class UploadController extends ActiveController
{
    public function actionUploadFile()
    {
	    /**
	     * 判断请求是get还是post
	     */
	    if (Yii::$app->request->isGet) {
		    $request = Yii::$app->request->get();
	    } elseif (Yii::$app->request->isPost) {
		    $request = Yii::$app->request->post();
	    }
	
	    /**
	     * 模型 属性 实例化文件上传模型
	     */
	    $model = new Upload();
	    $model->file = UploadedFile::getInstance($model, 'file');
	
	    $path = 'uploads/' . date('Ymd', time() . '/');
	
	    if ($model->file && $model->validate()) {
		    if (!is_dir($path)) {
			    mkdir($path, 0777);
		    }
		    //如果上传成功 跳转到api首页
		    $model->file->saveAs($path . time() . '.' . $model->file->baseName . '.' . $model->file->extension);
		
		    /**
		     * 上传成功 返回成功码
		     */
		    $arr = array('code' => '200', 'message' => '数据上传成功！',);
		    return json_encode($arr);
		
	    }
	
	    /**
	     * 否则上传失败 返回失败码
	     */
	    $arr = array('code' => '400', 'message' => '数据上传失败！',);
	    return json_encode($arr);
    }
}
