<?php
    /**
     * Created by PhpStorm.
     * User: s
     * Date: 17-3-17
     * Time: 上午10:10
     */
    
    namespace frontend\controllers;
    
    use yii\web\Controller;
    
    class TestController extends Controller
    {
        
        public function actionIndex($name)
        {
            echo "Hello {$name}";
        }
        
        public function actionCreate()
        {
            
        }
    }
    