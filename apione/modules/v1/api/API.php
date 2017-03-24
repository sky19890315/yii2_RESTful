<?php

namespace apione\modules\v1\api;

/**
 * api module definition class
 */
class API extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'apione\modules\v1\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
	    $this->modules = [
		    'user' => [
			    'class' => 'apione\modules\v1\api\modules\user\User',
		    ],
		
		    'goods' => [
			    'class' => 'apione\modules\v1\api\modules\goods\Goods',
		    ],
		
		    'users' => [
			    'class' => 'apione\modules\v1\api\modules\users\Users',
		    ],
	    ];
    }
}
