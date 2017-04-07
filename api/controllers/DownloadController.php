<?php

namespace api\controllers;
use Yii;

class DownloadController extends \yii\web\Controller
{
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
	   if (Yii::$app->request->isGet) {
	   	
	   }
	    
	    
	

	    
	    
	    
	    
    }

}
