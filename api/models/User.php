<?php

namespace api\models;

use Yii;
use yii\db\ActiveRecord;
use yii\filters\RateLimitInterface;
use yii\web\IdentityInterface;

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
 * class_implements — 返回指定的类实现的所有接口。
 * 本函数返回一个数组，该数组中包含了指定类class及其父类所实现的所有接口的名称。
 */
class User extends ActiveRecord implements IdentityInterface, RateLimitInterface
{
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
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'api_token'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'api_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
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
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'api_token' => 'Api Token',
        ];
    }
    
    //// 返回某一时间允许请求的最大数量，比如设置10秒内最多5次请求（小数量方便我们模拟测试）
	/**
	 * @param \yii\web\Request $request
	 * @param \yii\base\Action $action
	 * @return array
	 */
	public function getRateLimit ($request, $action)
	{
		return [5 ,10];
	}
	
	// 回剩余的允许的请求和相应的UNIX时间戳数 当最后一次速率限制检查时'
	public function loadAllowance ($request, $action)
	{
		return [$this->allowance, $this->allowance_updated_at];
	}
	
	// 保存允许剩余的请求数和当前的UNIX时间戳
	public function saveAllowance ($request, $action, $allowance, $timestamp)
	{
		//剩余的允许的请求数量
		//相应的UNIX时间戳数
		$this->allowance = $allowance;
		$this->allowance_updated_at = $timestamp;
		$this->save();
	}
	
	
}
