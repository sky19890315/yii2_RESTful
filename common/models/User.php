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
 * 已经通过实现认证接口 来完成认证任务
 * 我创建了一个用户类User 继承了 ActiveRecord 类 实现了 IdentityInterface 接口
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
	
	
	/**
	 * @return string
	 * 制定要查询的表  通过yii2 的特殊认证方法 取得user表名
	 *
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
	 *
	 *
	 */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	return static::findOne(['access_token' => $token]);
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
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
	
	/**
	 * 生成密钥
	 * @return string
	 */
    public function generateApiToken()
    {
    	//拼接生成的api
	    $this->api_token = Yii::$app->security->generateRandomString().'_'.time();
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
