<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_backend".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property string $api_token
 * @property integer $isAdmin
 * 调用接口来实现
 */
class AdminUser extends ActiveRecord implements IdentityInterface
{
	/**
	 * @return string
	 * 自动生成appid
	 */
	public function generaterAppId()
	{
		/*
		 * 获取当前时间戳
		 * 将当前时间戳随机打乱
		 * 将打乱的时间戳拼接到一个字符串
		 * 保证生成的appid的唯一性
		 * 果果做的一切都是为了保证产生的appid是唯一的
		 * 因为要确保产生的appid是唯一 两次打乱加上时间戳是打乱的
		 * 产生相同appid的几率几乎是零
		 */
		$date = time();
		$shf = str_shuffle($date).rand(1, 9999);
		return $this->appid = str_shuffle('pr'.str_shuffle($shf) );
	}
	
	
	
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_backend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username',  'password_hash', 'email'], 'required'],
	
	        /**
	         * 裁边是必须的 否则会造成不必要的麻烦
	         */
	        
	        [['username', 'email'], 'trim'],
	        
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password_hash', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     * 显示表的信息 如果有备注显示备注
     * 修改将会修改表单上显示的结果
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => '认证密钥',
            'password_hash' => '密码',
            'email' => '邮箱',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
	        'appid' =>  'AppId',
            'api_token' => 'AppToken',
            'isAdmin' => '用户身份',
        ];
    }
    
   
	/**
	 * 增加 根据接口获取用户
	 * @param int|string $id
	 * @return static
	 */
	public static function findIdentity ($id)
	{
		return static::findOne(['id' => $id]);
	}
	
	
	/**
	 *
	 *
	 *
	 * 根据accesss_token获取用户信息
	 *
	 * 2017-04-19 这里有一个bug  即user_backend表中 并没有api_token字段
	 * 需要后期加入修改 并去修改登录表单 让其自动生成api_token
	 * 才算是完成这个验证   直接去修改用户表
	 *
	 */
	public static function findIdentityByAccessToken ($token, $type = null)
	{
		return static::findOne(['api_token' => $token]);
	}
	
	/**
	 * @return mixed
	 * 标识获取id
	 */
	public function getId ()
	{
		// TODO: Implement getId() method.
		return $this->getPrimaryKey();
	}
	
	/**
	 * @return string
	 *
	 * 获取认证密钥
	 */
	public function getAuthKey ()
	{
		return $this->auth_key;
	}
	
	/**
	 * @param string $authKey
	 * @return bool
	 *
	 * 验证密钥
	 */
	public function validateAuthKey ($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}
	
	/**
	 *
	 *
	 * 用哈希算法加密
	 */
	public function setPassword($password)
	{
		return $this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}
	
	//增加生成key
	/**
	 * 秘钥
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}
	
	/**
	 * 根据用户表获取用户信息
	 * @param $username
	 * @return static
	 */
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username]);
	}
	
	/**
	 * 验证经过hash算法加密后的密码
	 * @param $password
	 * @return bool
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}
	
	/**
	 * 生成密钥
	 * @return string
	 *
	 * 静态属性不可以由对象通过 -> 操作符来访问。
	 */
	public function generateApiToken()
	{
		//拼接生成的api
		return $this->api_token = Yii::$app->security->generateRandomString().'/'.'http://api.prmeasure.com'.'/'.time();
	}
	
	/**
	 * 检验token是否有效
	 * @param $token
	 * @return bool
	 */
	public static function apiTokenIsValid($token)
	{
		if (empty($token)){
			return false;
		}
		
		//强制转换成整型 返回首次出现下划线的位置
		$timestamp = (int) substr($token, strripos($token, '_') +1);
		$expire = Yii::$app->params['user.apiTokenExpire'];
		
		return $timestamp + $expire >= time();
	}
	
	
	
}
