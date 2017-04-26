<?php
namespace common\models;

/**
 *                    _ooOoo_
 *                   o8888888o
 *                   88" . "88
 *                   (| -_- |)
 *                    O\ = /O
 *                ____/`---'\____
 *              .   ' \\| |// `.
 *               / \\||| : |||// \
 *             / _||||| -:- |||||- \
 *               | | \\\ - /// | |
 *             | \_| ''\---/'' | |
 *              \ .-\__ `-` ___/-. /
 *           ___`. .' /--.--\ `. . __
 *        ."" '< `.___\_<|>_/___.' >'"".
 *       | | : `- \`.;`\ _ /`;.`/ - ` : | |
 *         \ \ `-. \_ __\ /__ _/ .-` / /
 * ======`-.____`-.___\_____/___.-`____.-'======
 *                    `=---='
 *
 * .............................................
 *          佛祖保佑             永无BUG
 */

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\filters\RateLimitInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 *
 *
 * 这个模型不是自动生成的 是框架自带的 基本上所有的验证都走这个模型
 * 已经通过实现认证接口 来完成认证任务
 * 我创建了一个用户类User 继承了 ActiveRecord 类 实现了 IdentityInterface 接口
 *
 * 2017-04-13
 * API 的设计原则 只完成接口要做的事情 其它事情不去做
 * 所以以上的验证应该放入后台管理  在后台管理分配角色等
 * 这边只做验证使用
 *
 * 2017-04-17 开始接入请求频率限制接口
 * 频率请求接口里面只有三个接口 通通实现
 *
 * 2017-04-22 新增加appid自动生成的方法 可以做静态调用
 * 该方法会按时间戳自动生成一个独一无二的appid
 * 用来代替用户名 来做验证用户信息
 *
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
class User extends ActiveRecord implements IdentityInterface, RateLimitInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
	
	/**
	 * @return string
	 * 生成一组独特的appid作为用户登录的凭证
	 * 用户名可以改 而这个appid作为用户的唯一标识  是固定不变且独一无二的
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
	 * @return string
	 * 制定要查询的表  通过yii2 的特殊认证方法 取得user表名
	 * 关联到前台用户数据表
	 */
    public static function tableName()
    {
        return '{{%user}}';
    }
	
	/**
	 * @return array
	 */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
	
	/**
	 * @return array
	 */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }
	
	/**
	 * 根据给到的ID查询身份。
	 *
	 * @param int|string $id 被查询的ID
	 * @return static 通过ID匹配到的身份对象
	 * 根据指定的用户ID查找 认证模型类的实例，当你需要使用session来维持登录状态的时候会用到这个方法。
	 */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
	
	/**
	 * 20170412 sky 296675685@qq.com 启用授权认证系统
	 * @param mixed $token 被查询的 token
	 * @param null  $type
	 * @return static 通过 token 得到的身份对象
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 实现restful api 验证必须要实现的方法
	 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 *
	 * 根据 token 查询身份。
	 * 2017-04-18 将下面字段修改为api_token
	 * access_token' => $token
	 *
	 */
    public static function findIdentityByAccessToken($token, $type = null)
    {
	    /**
	     * 如下的字段应该对应好相对的时间
	     */
    	return static::findOne(['api_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
	
	/**
	 * @return int|string 当前用户ID  修改实现的方法 20170412
	 *
	 * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 * 实现restful api 验证必须要实现的方法
	 * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	 */
    public function getId()
    {
        return $this->id;
    }
	
	/**
	 * @return string
	 *
	 * 获取基于 cookie 登录时使用的认证密钥。 认证密钥储存在 cookie 里并且将来会与服务端的版本进行比较以确保 cookie的有效性。
	 */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
	
	/**
	 * @param string $authKey
	 * @return bool
	 *
	 * 是基于 cookie 登录密钥的 验证的逻辑的实现
	 */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     *
     */
    public function setPassword($password)
    {
         return $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        return $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        return $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
       return  $this->password_reset_token = null;
    }
	
	/**
	 * 生成密钥
	 * @return string
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
	
	/**
	 * 日期：2017-04-17
	 * 返回某一时间允许请求的最大数量，比如设置10秒内最多5次请求（小数量方便我们模拟测试）
	 * @author sky 296675685@qq.com
	 * @param \yii\web\Request $request
	 * @param \yii\base\Action $action
	 * @return array
	 */
    public function getRateLimit ($request, $action)
    {
	    return [5, 10];
    }
	
	/**
	 * 返回剩余的允许的请求和相应的UNIX时间戳数 当最后一次速率限制检查时
	 * @param \yii\web\Request $request
	 * @param \yii\base\Action $action
	 * @return array
	 */
    public function loadAllowance ($request, $action)
    {
	    return [$this->allowance, $this->allowance_updated_at];
    }
	
	/**
	 * 保存允许剩余的请求数和当前的UNIX时间戳
	 * @param \yii\web\Request $request
	 * @param \yii\base\Action $action
	 * @param int              $allowance
	 * @param int              $timestamp
	 */
    public function saveAllowance ($request, $action, $allowance, $timestamp)
    {
    	$this->allowance = $allowance;
    	$this->allowance_updated_at = time();
    	$this->save();
    }
    
    
    
    
    
}
