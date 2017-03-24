<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
    	
    	//用户认证模块
	    //authManager有phpmanager和DBmanager两种方式
	    'authManager'   => [
	    	'class'     =>  'yii\rbac\Dbmanager',
	    ],
    	
    	
    	
    	
    	
    	
    	
    	
    	
    	
        'cache' => [
            'class' => 'yii\caching\FileCache',
                   ],
                    ],
    // 配置语言
    'language'=>'zh-CN',
    // 配置时区
    'timeZone'=>'Asia/Chongqing',
        ];
