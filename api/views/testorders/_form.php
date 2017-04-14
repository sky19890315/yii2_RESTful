<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model api\models\Testorder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testorder-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ItemNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'State')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Priority')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MachineType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SampleNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SampleName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DelegationDepartment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Inspector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ExperimentArea')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DelegationPerson')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DelegationDate')->textInput() ?>

    <?= $form->field($model, 'DutyDepartment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Purpose')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InspectionDate')->textInput() ?>

    <?= $form->field($model, 'EstimatedDate')->textInput() ?>

    <?= $form->field($model, 'Affiliation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SampleBrand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SampleComment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InspectionBatchNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CompressorType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ControllerType')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InternalUnitNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ExternalUnitNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EstimatedLastDate')->textInput() ?>

    <?= $form->field($model, 'SchemeNO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InstallationCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ReceivedTime')->textInput() ?>

    <?= $form->field($model, 'Memo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
