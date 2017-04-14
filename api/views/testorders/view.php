<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model api\models\Testorder */

$this->title = $model->TestOrderNO_id;
$this->params['breadcrumbs'][] = ['label' => 'Testorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testorder-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->TestOrderNO_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->TestOrderNO_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'TestOrderNO_id',
            'ItemNO',
            'State',
            'Priority',
            'MachineType',
            'SampleNO',
            'SampleName',
            'Count',
            'DelegationDepartment',
            'Inspector',
            'ExperimentArea',
            'DelegationPerson',
            'DelegationDate',
            'DutyDepartment',
            'Purpose',
            'InspectionDate',
            'EstimatedDate',
            'Affiliation',
            'SampleBrand',
            'SampleComment',
            'InspectionBatchNO',
            'CompressorType',
            'ControllerType',
            'InternalUnitNO',
            'ExternalUnitNO',
            'EstimatedLastDate',
            'SchemeNO',
            'InstallationCode',
            'ReceivedTime',
            'Memo',
        ],
    ]) ?>

</div>
