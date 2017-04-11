<?php

namespace api\controllers;
use Yii;

/**
 * Class DownloadController
 * @package api\controllers
 */
class DownloadController extends \yii\web\Controller
{
	/**
	 * @return object
	 */
    public function actionIndex()
    {
	    /**
	     * @string
	     */
	    $path = 'uploads/' . date("Ymd", time()) . '/';
    	/**
	     * 先判断是否有文件 有则列出文件目录 否则返回目录下为空
	     */
    	if (empty($path)) {
		    /**
		     * 没有文件 返回code 400状态码
		     * @return mixed
		     */
		    return \Yii::createObject([
			    'class'     =>      'yii\web\Response',
			    'format'    =>      \yii\web\Response::FORMAT_JSON,
			    'data'      =>      [
				    'message'   =>  '找不到文件',
				    'code'      =>  '400',
			    ],
		
		    ]);
	    }
	    
	    /**
	     * @return mixed
	     * 目录下以时间戳为单位
	     */
	   $body = Yii::$app->db->createCommand('SELECT * FROM filePath')->queryAll();
	    return \Yii::createObject([
		    'class'     =>      'yii\web\Response',
		    'format'    =>      \yii\web\Response::FORMAT_JSON,
		    'data'      =>      [
			    'code'      =>  '200',
			    'content'   =>  $body,
		    ],
	
	    ]);
    }
	
	/**
	 * 根据提供的URL进行下载
	 */
    public function actionDownload()
    {
    	if (Yii::$app->request->isGet) {
    		
	    }
    }

}
