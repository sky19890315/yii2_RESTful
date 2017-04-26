<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
	


/* @var $this yii\web\View   视图名或文件路径，由实际的渲染方法决定  */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->hint('请输入用户名') ?>
	
	<?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint('请输入邮箱') ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true])->hint('请输入密码') ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
