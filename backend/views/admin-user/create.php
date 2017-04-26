<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminUser */

$this->title = '创建后台用户';
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="admin-user-form">
		
		<?php $form = ActiveForm::begin(); ?>
		
		<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
		
		<?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
		
		

        <div class="form-group">
		    <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <!--中间是实体符--> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!--中间是实体符-->
		    <?= Html::a('返回', 'index', ['class' => 'btn btn-warning']) ?>
        </div>
	
	    <?php ActiveForm::end(); ?>

        </div>
</div>
