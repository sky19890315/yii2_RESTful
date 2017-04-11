<?php
	
namespace backend\modules\rbac\controllers;
	
use backend\modules\rbac\models\Access;
use backend\modules\rbac\models\AppAccessLog;
use backend\modules\rbac\models\RoleAccess;
use backend\modules\rbac\models\User;
use backend\modules\rbac\models\UserRole;
use backend\services\UrlService;
use yii\web\Controller;
use Yii;

/**
 * Class BaseController
 * @package backend\modules\rbac\controllers
 * 作为所有RBAC权限控制器的基类
 * 并且继承常用共用方法
 */
class BaseController extends Controller
{
	protected $auth_cookie_name = 'imguowei_888';
	protected $current_user = null;
	protected $allowAllAction = [
		'user/login',
		'user/vlogin',
	];
	
	public $ignore_url = [
		'error/forbidden',
		'user/vlogin',
		'user/login'
	];
	
	/**
	 * 统一获取post参数的方法
	 * @param        $key
	 * @param string $default
	 * @return array|mixed
	 */
	public function post($key, $default = "")
	{
		return Yii::$app->request->post($key, $default);
	}
	
	/**
	 * 统一获取get参数的方法
	 * @param        $key
	 * @param string $default
	 * @return array|mixed
	 */
	public function get($key, $default = "")
	{
		return Yii::$app->request->get($key, $default);
	}
	
	/**
	 * 封装json返回值，主要用于js ajax 和 后端交互返回格式
	 * data:数据区 数组
	 * msg: 此次操作简单提示信息
	 * code: 状态码 200 表示成功，http 请求成功 状态码也是200
	 * @param array  $data
	 * @param string $msg
	 * @param int    $code
	 */
	public function renderJson($data=[], $msg ="ok", $code = 200)
	{
		header('Content-type: application/json');//设置头部内容格式
		echo json_encode([
			'code'  =>  $code,
			"msg"   =>  $msg,
			"data"  =>  $data,
			"req_id" =>  uniqid(),
		]);
		return Yii::$app->end();//终止请求直接返回
	}
	
	
	
	
}






















