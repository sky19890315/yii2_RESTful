<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    
    $this->title = '添加新用户';
    $this->params['breadcrumbs'][] = $this->title;
?>
    
<div class="site-signup" style="background-color: #f7e1b5">
    <div class="row">
        <div class="col-lg-5">
          <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
	
	
	        <?= $form->field($model, 'username')->label('登陆名')->textInput(['autofocus' => true]) ?>
	
	        <?= $form->field($model, 'email')->label('邮箱') ?>
	
	        <?= $form->field($model, 'password')->label('密码')->passwordInput() ?>

            <div class="form-group">
		        <?= Html::submitButton('添加', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>





            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
            