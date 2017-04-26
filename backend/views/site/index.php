<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
    use Yii;
	?>

<div class="bg-info">
    <br />
    <br />
<div class="row">
    <h2 class="text-center">欢迎登录<strong>PRMEASURE</strong>后台管理系统</h2>
</div>

    

<h3 class="bg-info text-center">当前系统时间: <?= date("北京时间Y年m月d日H:i:s"); ?></h3>
<br />
<br />
<br />
<div class="container-fluid text-center">
    <div class="row">

        <!-- Split button -->
        <div class="btn-group">
	
	        <?= Html::a('前台用户管理', 'user/index', ['class' => 'btn btn-warning']) ?>
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><?= Html::a('前台注册页面', 'user/signup', ['class' => 'btn btn-info']) ?></li>
                <li role="separator" class="divider"></li>
            </ul>
         
        </div>
            <!--前后台用户分隔符--> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--前后台用户分隔符-->
        
        <div class="btn-group">
	        <?= Html::a('后台用户管理', 'admin-user/index', ['class' => 'btn btn-warning']) ?>
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><?= Html::a('后台注册页面', ' site/signup', ['class' => 'btn btn-info']) ?></li>
                <li role="separator" class="divider"></li>
            </ul>
        </div>
        
        <!--中间有实体符-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--中间有实体符-->
        <!-- Split button -->
        <div class="btn-group">
	        <?= Html::a('路由管理', ['admin/'], ['class' => 'btn btn-warning']) ?>
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><?= Html::a('角色', ['admin/role'], ['class' => 'btn btn-info']) ?></li>
                <li><?= Html::a('菜单', ['admin/menu'], ['class' => 'btn btn-info']) ?></li>
                <li><?= Html::a('路由', ['admin/menu'], ['class' => 'btn btn-info']) ?></li>
                <li role="separator" class="divider"></li>
                <li><?= Html::a('权限', ['admin/menu'], ['class' => 'btn btn-info']) ?></li>
            </ul>
        </div>
    <!--中间是一堆实体符-->  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!--中间是一堆实体符-->
	    <?= Html::a('权限管理', ['rbac/index'], ['class' => 'btn btn-danger']) ?>
        
    </div>
    <br />
    <br />
    <br />
    <br />
    
    <div class="row">
        <a href="http://api.prmeasure.com"> <button type="button" class="btn btn-success">PRMEASURE API系统</button></a>
     
        
        <!--中间有很多实体符号-->    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <!--中间有很多实体符号-->
        
	    <?= Html::a('API认证用户注册', ['user/signup'], ['class' => 'btn btn-info']) ?>
    
    </div>
    <hr />

    <br />
    <br />
    <br />
    <br />
    <br />
</div>
</div>