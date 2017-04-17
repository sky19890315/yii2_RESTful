<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\AdminUser;

/**
 * Class SignupForm
 * @package backend\models
 */
class SignupForm extends Model
{
    //设置公共属性
	public $username;
	public $email;
	public $password;
	
	public $created_at;
	public $updated_at;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
    	//自定义筛选格式
        return [
        	//去除两边空格
	        ['username', 'filter', 'filter' => 'trim'],
	        
	        //验证 鉴权应该放在前端
	        ['username', 'required', 'message' => '用户名不能为空'],
	        
	        //唯一性验证
	        ['username', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '用户名已存在'],
	        
	        //限定字符串类型 最小2 最大255
	        ['username', 'string', 'min' => 2, 'max' => 255],
	        
	        //过滤邮箱
	        ['email', 'filter', 'filter' => 'trim'],
	        ['email', 'required', 'message' => '邮箱不能为空'],
	        //验证邮箱格式 利用yii2自带的正则表达式
	        ['email', 'email'],
	        ['email', 'string', 'max' => 255],
	        //唯一性验证
	        ['email', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '用户名已存在'],
	        
	        //验证密码
	        ['password', 'required', 'message' => '密码不能为空'],
	        ['password', 'string', 'min' => 6, 'tooShort' => '密码至少为6位'],
	        //加强行验证 当创建时间和更新时间为空才赋值
	        [['created_at', 'updated_at'], 'default', 'value' => date('Y-m-d H:i:s')],
	        
        
        ];
    }

	//登录验证
	/**
	 * @return bool|null
	 */
	public function signup()
	{
		//调用验证方法
		if (!$this->validate()){
			//如果不满足以上条件，直接返回空
			return null;
		}
		
		//满足以上条件，写入数据库
		//将当前获得的值赋予对象并写入数据库
		$user = new AdminUser();
		$user->username     =   $this->username;
		$user->email        =   $this->email;
		$user->created_at   =   $this->created_at;
		$user->updated_at   =   $this->updated_at;
		
		//加密密码
		$user->setPassword($this->password);
		
		//自动生成认证key
		$user->generateAuthKey();
		
		// save(false)的意思是：不调用UserBackend的rules再做校验并实现数据入库操作
        // 这里这个false如果不加，save底层会调用UserBackend的rules方法再对数据进行一次校验，因为我们上面已经调用Signup的rules校验过了，这里就没必要在用UserBackend的rules校验了
		return $user->save(false);
	}
}
