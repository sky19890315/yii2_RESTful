<?php
	
namespace common\controllers;

use yii\web\Controller;

/**
 * Class CommonController
 * @package common\controllers
 */
class CommonController extends Controller{
	/*
	  * 操作成功显示提示信息
	  * @param string $info,显示的信息提示
	  * @param array $url,二维数组，将要跳转的链接，格式：[[urlText1,url1],[urlText2,url2]......]
	  * @param int $jumpseconds,自动跳转到第一个链接的秒数，-1：不自动跳转；0：当即跳转；大于0的整数：信息显示的秒数
	  * @return exit
	 * sample:
	 * return $this->success('Submit success,Thank you!',[['首页','/'],['购物车','/shopping-cart/index']],3);
	  * */
	public function success($info,$url=[],$jumpSeconds=-1){
		if(!empty($url)&&empty($jumpSeconds)){
			return $this->redirect($url[0]);
		}else{
			$this->layout='empty';
			return $this->render('@app/views/info/success',[
				'info'=>$info,
				'url'=>$url,
				'jumpSeconds'=>$jumpSeconds,
			]);
		}
	}
	/*
	 * 操作失败显示提示信息
	 * @param string $info,显示的信息提示
	 * @param array $url,二维数组，将要跳转的链接，格式：[[urlText1,url1],[urlText2,url2]......]
	 * @param int $jumpseconds,自动跳转到第一个链接的秒数，-1：不自动跳转；0：当即跳转；大于0的整数：信息显示的秒数
	 * @return exit
	 * */
	public function error($info,$url=[],$jumpSeconds=-1){
		if(!empty($url)&&empty($jumpSeconds)){
			return $this->redirect($url[0]);
		}else{
			$this->layout='empty';
			return $this->render('@app/views/info/errormsg',[
				'info'=>$info,
				'url'=>$url,
				'jumpSeconds'=>$jumpSeconds,
			]);
		}
	}
	/*
	 * 调用信息提示页面
	 * @param string $info,显示的信息提示
	 * @param array $url,二维数组，将要跳转的链接，格式：[[urlText1,url1],[urlText2,url2]......]
	 * @param int $jumpseconds,自动跳转到第一个链接的秒数，-1：不自动跳转；0：当即跳转；大于0的整数：信息显示的秒数
	 * @return exit
	 * */
	public function info($info,$url=[],$jumpSeconds=-1){
		if(!empty($url)&&empty($jumpSeconds)){
			return $this->redirect($url[0]);
		}else{
			$this->layout='empty';
			return $this->render('@app/views/info/info',[
				'info'=>$info,
				'url'=>$url,
				'jumpSeconds'=>$jumpSeconds,
			]);
		}
	}
	/*
	 * 显示model数据验证失败错误信息（专用）注意：仅在调试模式时显示
	 * 示例： $this->errorDisplay($model->getErrors());
	 * @param array $errorArray,错误信息数组，样例：$errorArr=[['Author is empty!']];
	 * @return exit
	 * */
	public function errorDisplay($errorArray){
		$errorstr="";
		if(YII_DEBUG&&$errorArray&&is_array($errorArray)){
			foreach ($errorArray as $k=>$error) {
				if(is_array($error)){
					$errorstr.=implode("\n\n",$error)."\n\n";
				}else{
					$errorstr.="Have Error\n\n";
				}
			}
		}
		if(!$errorstr){
			$errorstr="Have error!\n\n";
		}
		return $this->error($errorstr);
	}
}