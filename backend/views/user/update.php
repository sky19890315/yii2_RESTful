<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '用户ID: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="user-form">
		
		<?php $form = ActiveForm::begin(); ?>
		
		<?= $form->field($model, 'username')->textInput(['maxlength' => true])->hint('请输入用户名') ?>
		
		<?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint('请输入邮箱') ?>
	
	    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true])->hint('请输入密码') ?>
        
        <div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <!--中间是实体符-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--中间是实体符-->
	        <?= Html::a('返回', ['index'], ['class' => 'btn btn-warning']) ?>
        
        </div>
		
		<?php ActiveForm::end(); ?>

    </div>
    

</div>
