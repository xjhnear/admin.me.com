<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '约见管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="see-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'user.nickname',
            'dianping.name',
            //'obj_sex',
            //'see_time:datetime',
    		'see_time',
    		
            [
            'label'=>'约见状态',
            'attribute' => 'status',
            'value' => function ($dataProvider) {
            return Yii::$app->params['see_status'][$dataProvider->status];
            }
            ],
            // 'message',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} '],
        ],
    ]); ?>

</div>
