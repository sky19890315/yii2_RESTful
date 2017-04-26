<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
	
	/* @var $this yii\web\View */
	/* @var $form yii\bootstrap\ActiveForm */
	/* @var $model \common\models\LoginForm */
	
	$this->title = 'PRMEASURE后台管理系统登录页面';
	
	$fieldOptions1 = [
		'options' => ['class' => 'form-group has-feedback'],
		'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
	];
	
	$fieldOptions2 = [
		'options' => ['class' => 'form-group has-feedback'],
		'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
	];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>PRMEASURE</b>管理系统</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">请登录</p>
		
		<?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
		
		<?= $form
			->field($model, 'username', $fieldOptions1)
			->label('用户名')
			->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
		
		<?= $form
			->field($model, 'password', $fieldOptions2)
			->label('密码')
			->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <!-- /.col -->
            <div class="col-xs-4">
				<p><?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?></p>
            </div>
            <!-- /.col -->
        </div>
        
		<?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
