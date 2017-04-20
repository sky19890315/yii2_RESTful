<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
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
                <li><?= Html::a('创建用户', 'user/create', ['class' => 'btn btn-info']) ?></li>
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
                <li><?= Html::a('创建用户', 'admin-user/create', ['class' => 'btn btn-info']) ?></li>
                <li role="separator" class="divider"></li>
            </ul>
        </div>
        
        <!--中间有实体符-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--中间有实体符-->
        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-warning">路由管理</button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">用户权限</a></li>
                <li><a href="#">角色列表</a></li>
                <li><a href="#">路由菜单</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">路由列表</a></li>
                <li><a href="#">增加权限</a></li>
            </ul>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
        <a href="http://back.com/rbac/index"> <button type="button" class="btn btn-danger">权限管理</button></a>
    </div>
    <br />
    <br />
    <br />
    <br />
    
    <div class="row">
        <a href="http://api.prmeasure.com"> <button type="button" class="btn btn-success">PRMEASURE API系统</button></a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="http://back.com/user/signup"> <button type="button" class="btn btn-success">API认证用户注册</button></a>
    </div>
    <hr />

    <br />
    <br />
    <br />
    <br />
    <br />
</div>
</div>