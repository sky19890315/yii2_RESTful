<?php
	/* @var $this yii\web\View */
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

?>
<h1>文件管理页面</h1>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>文件上传</title>
</head>
<body>

<?php $form=ActiveForm::begin([
	'id'=>'upload',
	'enableAjaxValidation' => false,
	'options'=>['enctype'=>'multipart/form-data']
]);
?>
<?= $form->field($model ,'file')->fileInput(); ?>
<?=  Html::submitButton('提交', ['class'=>'btn btn-primary','name' =>'submit-button']) ?>

<?php ActiveForm::end(); ?>




<button><a href="http://api.com/v1/file">返回文件管理</a></button>
<br/>
<br/>
<br/>
<br/>


</body>
</html>