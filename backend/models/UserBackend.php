<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

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
class UserBackend extends \yii\db\ActiveRecord implements IdentityInterface
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
    
    //增加 根据接口获取用户
	/**
	 * @param int|string $id
	 * @return static
	 */
	public static function findIdentity ($id)
	{
		// TODO: Implement findIdentity() method.
		return static::findOne(['id' => $id]);
	}
	
	//根据accesss_token获取用户信息
	/**
	 * @param mixed $token
	 * @param null  $type
	 * @throws NotSupportedException
	 */
	public static function findIdentityByAccessToken ($token, $type = null)
	{
		// TODO: Implement findIdentityByAccessToken() method.
		//暂时先不启用 直接抛出异常 暂时不提供这个方法
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}
	
	//标识获取id
	/**
	 * @return mixed
	 */
	public function getId ()
	{
		// TODO: Implement getId() method.
		return $this->getPrimaryKey();
	}
	
	//获取认证密钥
	/**
	 * @return string
	 */
	public function getAuthKey ()
	{
		// TODO: Implement getAuthKey() method.
		return $this->auth_key;
	}
	
	//验证密钥
	/**
	 * @param string $authKey
	 * @return bool
	 */
	public function validateAuthKey ($authKey)
	{
		// TODO: Implement validateAuthKey() method.
		return $this->getAuthKey() === $authKey;
	}
	
	//用哈希算法加密
	/**
	 * @param $password
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
