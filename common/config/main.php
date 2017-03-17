<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],



 
        
        
        
        
        
    // 配置数据库
  /*  'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=127.0.0.1;dbname=yii',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'enableSchemaCache' => true,
        'schemaCacheDuration' => 24*3600,
        'schemaCache' => 'cache',
    ],*/
],
    // 配置语言
    'language'=>'zh-CN',
    // 配置时区
    'timeZone'=>'Asia/Chongqing',
    
    
    
    
    
];
