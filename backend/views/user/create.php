<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '创建用户';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

     <h1><?= Html::encode($this->title) ?></h1>

   

    <div class="user-form">
		
		<?php $form = ActiveForm::begin(); ?>
		
		<?= $form->field($model, 'username')->textInput(['maxlength' => true])->hint('请输入用户名') ?>
		
		<?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint('请输入邮箱') ?>
		
		<?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true])->hint('请输入密码') ?>

        <div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <!--中间是实体符-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--中间是实体符-->
	        <?= Html::a('取消', ['index'], ['class' => 'btn btn-warning']) ?>
        </div>
		
		<?php ActiveForm::end(); ?>

    </div>

   
    
</div>

