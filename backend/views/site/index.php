<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	?>

<div class="bg-info">
    <br />
    <br />
<h2 class="bg-primary text-center">欢迎登录<strong>PRMEASURE</strong>后台管理系统</h2>
<h3 class="bg-info text-center">当前系统时间: <?= date("北京时间Y年m月d日H:i:s"); ?></h3>
<br />
<br />
<br />
<div class="container-fluid text-center">
    <div class="row">

        <!-- Split button -->
        <div class="btn-group">
            <button type="button" class="btn btn-warning">用户管理</button>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">用户列表</a></li>
                <li><a href="#">增加用户</a></li>
                <li><a href="#">更新用户</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">删除用户</a></li>
            </ul>
        </div>
        
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
    <div class="row">
        <a href="http://api.prmeasure.com"> <button type="button" class="btn btn-success">前往PRMEASURE API系统</button></a>
    </div>
    <hr />

    <br />



    <br />
    <br />
    
    <?php
    $form = ActiveForm::begin([
    'method' => 'post',
    'action' => ['site/logout'],
    ]);
    ?>
    <?= Html::submitButton('退出后台管理系统', ['class' => 'btn btn-danger']) ?>
    <?php ActiveForm::end(); ?>
    
    <br />
    <br />
</div>
</div>