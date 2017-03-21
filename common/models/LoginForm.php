<?php
namespace common\models;

use Yii;
use yii\base\Model;
//调用登录设置
use backend\models\UserBackend as User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
    	//获取rules验证失败数据
        if (!$this->hasErrors()) {
        	//获取当前用户
            $user = $this->getUser();
	
	        // 获取到用户信息，然后校验用户的密码对不对，校验密码调用的是 backend\models\UserBackend
	        // 的validatePassword方法，
	        // 这个我们下面会在UserBackend方法里增加
            if (!$user || !$user->validatePassword($this->password)) {
            	//验证失败返回信息
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
	    // 调用validate方法 进行rule的校验，其中包括用户是否存在和密码是否正确的校验
        if ($this->validate()) {
	
	        // 校验成功后，session保存用户信息
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
	
	        // 根据用户名 调用认证类 backend\models\UserBackend 的 findByUsername 获取用户认证信息
	        // 这个我们下面会在UserBackend增加一个findByUsername方法对其实现
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
