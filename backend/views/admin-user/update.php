<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminUser */

$this->title = '用户: id=' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-user-update">
	
	<?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'isAdmin')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true])->hint('请输入6位以上密码') ?>
    
    <div class="form-group">
		<?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <!--中间是实体符--> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <!--中间是实体符-->
	    <?= Html::a('返回', 'index', ['class' => 'btn btn-warning']) ?>
    
    </div>
	
	<?php ActiveForm::end(); ?>

   
</div>

</div>
