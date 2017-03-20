<?php
namespace apidev\controllers;

use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	/*$arr = array(
    	'current_api_style'         =>      'RESTful Web API',
	    'current_api_version'       =>      'v1',
        'current_api_url'           =>      'http://api.dev.com',
        'current_test_url'          =>      'http://api.dev.com/v1/cars',
        'current_test_get'          =>      'http://api.dev.com/v1/cars/1',
	    'current_test_post'         =>      'http://api.dev.com/v1/cars/1',
	    'current_test_put'          =>      'http://api.dev.com/v1/cars/1',
	    'current_test_delete'       =>      'http://api.dev.com/v1/cars/1',
		 
	    );
        
    	$rst = json_encode($arr);
    	return $rst;
    	*/
    	echo "我佛镇守，永无BUG";
    	echo "current_api_style:RESTful Web API";
    	
    	
    }

  
}
