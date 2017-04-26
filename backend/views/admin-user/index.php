<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '后台用户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加新用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'email:email',
            'isAdmin',
            'appid',
            'api_token',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?= Html::a('返回', ['site/index'], ['class' => 'btn btn-warning']) ?>