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
class UserBackend extends ActiveRecord implements IdentityInterface
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
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
	 * @param mixed $token
	 * @param null  $type
	 * @throws NotSupportedException
	 * 根据accesss_token获取用户信息
	 */
	public static function findIdentityByAccessToken ($token, $type = null)
	{
		//暂时先不启用 直接抛出异常 暂时不提供这个方法
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
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
