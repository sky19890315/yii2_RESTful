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
	 * @return array
	 * 这个行为的作用是自动更新创建时间和更新时间
	 * 因为我们要创建用户 当然不希望每个值都填充
	 * 在插入数据库之前创建时间 更新时间
	 * 在插入数据库之后更新时间
	 * 当记录插入时， 行为将当前的 UNIX 时间戳赋值给 created_at 和 updated_at 属性；
	 * 当记录更新时，行为将当前的 UNIX 时间戳赋值给 updated_at 属性。
	 */
	public function behaviors ()
	{
		return [
			'class' =>  TimestampBehavior::className(),
			'attributes' => [
				ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
				ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
			],
		];
	}
	
	
	/**
	 * @param bool $insert
	 * @return bool
	 *
	 */
	
	/*
	public $username = null;
	public $auth_key;
	public $password_hash;
	public $status;
	public $created_at;
	public $updated_at;
	public $api_token;
	public $allowance = 5;
	public $allowance_updated_at;
	
	public function __construct ()
	{
		if ($this->username === null) {
			return null;
		}
		if (empty($this->auth_key)) {
		$user = new \common\models\User();
		$this->auth_key = $user->generateAuthKey();
		$this->password_hash = $user->setPassword($this->password_hash);
		$this->created_at = time();
		$this->updated_at = time();
		$this->allowance_updated_at = time();
		$user->save(false);
		}
	}
	*/
	
	
	public function beforeSave ($insert)
	{
	////修改修改
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
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at', 'allowance', 'allowance_updated_at'], 'integer'],
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
            'api_token' => '认证密钥',
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
