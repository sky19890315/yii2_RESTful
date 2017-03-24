<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
//增加的路由别名
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
//增加开发分支路由
Yii::setAlias('@apidev', dirname(dirname(__DIR__)) . '/apidev');
//新增加两个开发分支
	Yii::setAlias('@apione', dirname(dirname(__DIR__)) . '/apione');
	Yii::setAlias('@apiopen', dirname(dirname(__DIR__)) . '/apiopen');