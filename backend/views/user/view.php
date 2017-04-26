<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '当前用户ID：'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
	        'api_token',
            //'status',
            [ 'attribute' => 'created_at',
                'value' => date('Y-m-d H:i:s', $model->created_at),
            ],
	
	        [ 'attribute' => 'updated_at',
	          'value' => date('Y-m-d H:i:s', $model->updated_at),
	        ],
            'allowance',
            'allowance_updated_at',
           
        ],
        //
    ]) ?>

    <p>
		<?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!--中间是实体符-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--中间是实体符-->
		<?= Html::a('删除', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => '你确认要删除该条数据?',
				'method' => 'post',
			],
		]) ?>
        <!--中间是实体符-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--中间是实体符-->
		<?= Html::a('返回', ['index'], ['class' => 'btn btn-warning']) ?>

    </p>
    
    
</div>
