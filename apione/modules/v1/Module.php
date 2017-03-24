<?php

namespace apione\modules\v1;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'apione\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        //设置访问路径
	    $this->modules = [
		    'api' => [
			    'class' => 'apione\modules\v1\api\API',
		            ],
	    	];
        
        

        // custom initialization code goes here
    }
}
