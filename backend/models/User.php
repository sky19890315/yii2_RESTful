<?php

namespace backend\models;

// 这个控制器类的作用是显示表单数据
//
//   █████▒█    ██  ▄████▄   ██ ▄█▀       ██████╗ ██╗   ██╗ ██████╗
// ▓██   ▒ ██  ▓██▒▒██▀ ▀█   ██▄█▒        ██╔══██╗██║   ██║██╔════╝
// ▒████ ░▓██  ▒██░▒▓█    ▄ ▓███▄░        ██████╔╝██║   ██║██║  ███╗
// ░▓█▒  ░▓▓█  ░██░▒▓▓▄ ▄██▒▓██ █▄        ██╔══██╗██║   ██║██║   ██║
// ░▒█░   ▒▒█████▓ ▒ ▓███▀ ░▒██▒ █▄       ██████╔╝╚██████╔╝╚██████╔╝
//  ▒ ░   ░▒▓▒ ▒ ▒ ░ ░▒ ▒  ░▒ ▒▒ ▓▒       ╚═════╝  ╚═════╝  ╚═════╝
//  ░     ░░▒░ ░ ░   ░  ▒   ░ ░▒ ▒░
//  ░ ░    ░░░ ░ ░ ░        ░ ░░ ░
//           ░     ░ ░      ░  ░



// 这个控制器类的作用是显示表单数据


use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $api_token
 * @property integer $allowance
 * @property integer $allowance_updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
	/**
	 * @param bool $insert
	 * @return bool
	 *
	 */
	/**
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++==
	 *
	 * 注意 这是一个大坑 只针对前台用户用的
	 * 生成的表作用与前台用户
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 相当于一个构造函数 即其父类封装了构造函数
	 * 通过在写入数据库之前进行插入
	 * 可以对数据库进行写入前的操作
	 * 比如有很多数据 是不需要用户去一一填写的
	 * 这些数据可以作为属性值 进行赋予 2017-04-21
	 * 因为之前的数据都是对数据库的一些操作
	 * 凡是以下列出的都不需要在表单中填写
	 */
	public function beforeSave ($insert)
	{
		if (parent::beforeSave($insert)) {
			
			/**
			 * 实例化系统自带的模型类
			 * 用以调用其方法
			 */
			
			$obj = new \common\models\User();
			/*
			 * 以下列出的都是自动生成的部分
			 * 在数据写入数据库之前 这些将会执行
			 */
			 $this->created_at  = time();
			 $this->updated_at  = time();
			 $this->api_token   = $obj->generateApiToken();
			 $this->auth_key    = $obj->generateAuthKey();
			 $this->password_hash = $obj->setPassword('password_hash');
		
			 return true;
		} else {
			return false;
		}
	}
	
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required'],
            [['status', 'allowance'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'api_token'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     * 以下的值将决定显示在表单页面的数据
     * 因为是通过gii自动生成的 所以会直接根据字段名称
     * 生成对应表
     * 可以做相应的删除 不影响效果 但是要和表单一一对应
     *  以下键值对一一对应 user/_form表单中显示的数据一一对应
     * 删除不会有神码影响
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => '认证密钥',
            'password_hash' => '密码',
            'password_reset_token' => '密码重置密钥',
            'email' => '邮箱',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'api_token' => 'API认证密钥',
            'allowance' => '剩余请求次数',
            'allowance_updated_at' => '请求更新时间',
        ];
    }
    
    /**
     * 以下为实现 验证接口
     * 需要一一实现这些接口
     * 按从静态到动态的顺序进行排列
     */
	/**
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
	 * 注意以下的字段要一一对应
	 * 与数据表中的api token字段对应
	 */
	public static function findIdentityByAccessToken ($token, $type = null)
	{
		return static::findOne(['api_token' => $token]);
	}
	
	public function getId ()
	{
		return $this->getPrimaryKey();
	}
	
	public function getAuthKey ()
	{
		return $this->auth_key;
	}
	
	/**
	 * @param string $authKey
	 * @return bool
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}
	
	
	
	
	
	
	
}
