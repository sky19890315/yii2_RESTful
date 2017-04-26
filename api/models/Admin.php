<?php

namespace api\models;

use Yii;

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
 */
class Admin extends \yii\db\ActiveRecord
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
            [['username', 'auth_key', 'password_hash', 'email'], 'string', 'max' => 255],
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
            'username' => '用户名',
            'auth_key' => '认证密钥',
            'password_hash' => '密码',
            'email' => '邮箱',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
	
	/**
	 * @return array
	 *  指定返回的数据
	 * 在以下表中列出的字段 即为显示在api上
	 * 对应字段在数据表中的值
	 */
	public function fields ()
	{
		return [
			'id' ,
			'username',
			'email' ,
			'created_at',
			
		];
	
	}
	

	
	
}
