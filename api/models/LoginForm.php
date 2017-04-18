<?php

namespace api\models;

use Yii;
use yii\base\Model;
use common\models\User;

class LoginForm extends Model
{
	public $username;
	public $password;
	
	private $_user;
	
	/**
	 * 定义常量
	 */
	const GET_API_TOKEN = 'generate_api_token';
	
	/**
	 * 事件嵌套处理功能
	 */
	public function init ()
	{
		parent::init();
		$this->on(self::GET_API_TOKEN, [$this, 'onGenerateApiToken']);
	}
	
	/**
	 * 添加验证规则
	 * @return array
	 */
	public function rules ()
	{
		return [
			[['username', 'password' ], 'required'],
			['password', 'validatePassword'],
		];
	}
	
	/**
	 *  根据用户名获取用户的认证信息
	 * 如果 _user为空 则通过用户输入的用户名去数据库查找用户信息
	 * 并将查找到的用户信息返回 即将得到的值给_user
	 * 在数据库中查找不到数据 则返回空
	 * @return null|static
	 */
	public function getUser()
	{
		if ($this->_user === null) {
			$this->_user = User::findByUsername($this->username);
		}
		
		return $this->_user;
	}
	
	/**
	 * 对用户输入的密码进行验证 错误直接返回错误信息
	 */
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$this->_user = $this->getUser();
			/**
			 * 如果上面走的通 则走以下步骤
			 */
			if (!$this->_user || !$this->_user->validatePassword($this->password)) {
				$this->addErrors($attribute, '用户名或者密码错误.');
			}
			
		}
	}
	
	/**
	 * 设置表单属性
	 * @return array
	 */
	public function attributeLabels ()
	{
		return [
			'username'  =>  '用户名',
			'password'  =>  '密码',
		];
	}
	
	/**
	 * 模拟登录
	 * @return null
	 */
	public function login()
	{
		if ($this->validate()) {
			$this->trigger(self::GET_API_TOKEN);
			return $this->_user;
		} else {
			return null;
		}
	}
	
	/**
	 * 登录校验成功后，为用户生成新的token
	 * 如果token失效，则重新生成token
	 */
	public function onGenerateApiToken()
	{
		if (!User::apiTokenIsValid($this->_user->api_token)) {
			$this->_user->generateApiToken();
			$this->_user->save(false);
			
		}
	}
	
	
}
	
	
	
	
	
	
	
	
	
	