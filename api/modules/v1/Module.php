<?php

namespace api\modules\v1;

/**
 * v1 module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
	    //增加文件上传模块
	    return [
		
		    'modules' => [
			    'upload' => [
				    'class' => 'api\modules\v1\upload\Module',
			    ],
		    ],
	    	
	    ];
    }
}
