<?php

namespace api\modules\v1\controllers;

use api\modules\v1\controllers\BaseController;
use yii\web\Response;

/**
 * Class UsersController
 * @package api\modules\v1\controllers
 */
class UsersController extends BaseController
{
	public $modelClass = 'api\models\Users';
	
}
