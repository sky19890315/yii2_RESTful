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
 * 调用接口来实现
 */
class AdminUser extends ActiveRecord implements IdentityInterface
{
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
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
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
	 * @param $password
	 *
	 * 用哈希算法加密
	 */
	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
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
	
}
