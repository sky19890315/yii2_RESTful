<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Testorders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testorder-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Testorder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'TestOrderNO_id',
            'ItemNO',
            'State',
            'Priority',
            'MachineType',
            // 'SampleNO',
            // 'SampleName',
            // 'Count',
            // 'DelegationDepartment',
            // 'Inspector',
            // 'ExperimentArea',
            // 'DelegationPerson',
            // 'DelegationDate',
            // 'DutyDepartment',
            // 'Purpose',
            // 'InspectionDate',
            // 'EstimatedDate',
            // 'Affiliation',
            // 'SampleBrand',
            // 'SampleComment',
            // 'InspectionBatchNO',
            // 'CompressorType',
            // 'ControllerType',
            // 'InternalUnitNO',
            // 'ExternalUnitNO',
            // 'EstimatedLastDate',
            // 'SchemeNO',
            // 'InstallationCode',
            // 'ReceivedTime',
            // 'Memo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
