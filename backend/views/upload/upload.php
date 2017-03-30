<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文件上传</title>
</head>
<body>
<?php if(Yii::$app->session->hasFlash('success')):?>
	<div class="alert alert-danger">
		<?=Yii::$app->session->getFlash('success')?>
	</div>
<?php endif ?>
<?php $form=ActiveForm::begin([
	'id'=>'upload',
	'enableAjaxValidation' => false,
	'options'=>['enctype'=>'multipart/form-data']
]);
?>
<?= $form->field($model ,'file')->fileInput(); ?>
<?=  Html::submitButton('提交', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?= Html::a('<span class="logo-lg">' . '返回首页'. '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

<?php ActiveForm::end(); ?>

</body>
</html>