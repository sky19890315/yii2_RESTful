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
	public static function findIdentity ($id)
	{
		// TODO: Implement findIdentity() method.
		return static::findOne(['id' => $id]);
	}
	
	//根据accesss_token获取用户信息
	public static function findIdentityByAccessToken ($token, $type = null)
	{
		// TODO: Implement findIdentityByAccessToken() method.
		//暂时先不启用 直接抛出异常 暂时不提供这个方法
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}
	
	//标识获取id
	public function getId ()
	{
		// TODO: Implement getId() method.
		return $this->getPrimaryKey();
	}
	
	//获取认证密钥
	public function getAuthKey ()
	{
		// TODO: Implement getAuthKey() method.
		return $this->auth_key;
	}
	
	//验证密钥
	public function validateAuthKey ($authKey)
	{
		// TODO: Implement validateAuthKey() method.
		return $this->getAuthKey() === $authKey;
	}
	
	
}
