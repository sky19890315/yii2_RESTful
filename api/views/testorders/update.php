<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model api\models\Testorder */

$this->title = 'Update Testorder: ' . $model->TestOrderNO_id;
$this->params['breadcrumbs'][] = ['label' => 'Testorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->TestOrderNO_id, 'url' => ['view', 'id' => $model->TestOrderNO_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="testorder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
