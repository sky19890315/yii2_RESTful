<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminUser */

$this->title = '用户ID：'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admin Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            //'auth_key',
            'email:email',
            'appid',
            'api_token',
            ['attribute' => 'isAdmin',
                'label'  => '用户身份',
            ],
            
            ['attribute' => 'created_at',
                'value' =>  date('Y-m-d H:i:s', $model->created_at),
            ],
	        ['attribute' => 'updated_at',
	         'value' =>  date('Y-m-d H:i:s', $model->updated_at),
	        ],
        ],
    ]) ?>

    <p>
		<?= Html::a('删除', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => '请确认是否删除这条记录?',
				'method' => 'post',
			],
		]) ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <?= Html::a('返回', 'index', ['class' => 'btn btn-warning']) ?>
    </p>
    
</div>
