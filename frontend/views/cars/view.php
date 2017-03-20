<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model api\models\Cars */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cars-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->carId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->carId], [
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
            'carId',
            'name',
            'age',
            'color',
        ],
    ]) ?>

</div>
