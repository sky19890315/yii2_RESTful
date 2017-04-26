<?php

namespace backend\models;

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
//

use Yii;
use yii\base\Model;
use common\models\User;


/**
 * Class Usersignup
 * @package backend\models
 * 这个类存在的意义是调用前端用户表user
 * 因为我不开发前端 所以front可能会在后期删除 删除之后
 * 需要从这个入口进行api用户的注册
 *  这个入口注册的是普通的用户
 *  对于这种大驼峰的写法 在视图文件中 需要用 - 做链接符号表示 例如
 * user-signup-form
 */
class UserSignupForm extends Model
{
	public $username;
	public $email;
	public $password;
	public $created_at;
	public $updated_at;
	
	public $value;// 自动补充的值，默认为time()
	
	
	
	
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
		    ['username', 'trim'],
		    ['username', 'required'],
		    ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
		    ['username', 'string', 'min' => 2, 'max' => 255],
		
		    ['email', 'trim'],
		    ['email', 'required'],
		    ['email', 'email'],
		    ['email', 'string', 'max' => 255],
		    ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
		
		    ['password', 'required'],
		    ['password', 'string', 'min' => 6],
	    ];
    }
	
	/**
	 * Signs user up.
	 * 如果用户注册 则制动生成以下的
	 * 因为用输入有限 更多的需要我们自己去生成
	 * 因为model重名了 只能将命名空间写入类前面
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function signup()
	{
		
		
		if (!$this->validate()) {
			return null;
		}
		
		//用户输入
		$user= new User();
		$user->username = $this->username;
		$user->email = $this->email;
		$user->setPassword($this->password);
		
		//以下是自动生成部分
		$user->generateApiToken();
		$user->generateAuthKey();
		
		
		return $user->save() ? $user :null;
	
	}
    
    


}
