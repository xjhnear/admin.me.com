<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

function status($v, $filed) {
    switch($v->{$filed}) {
        case 0:
            return '<span class="label label-default">未上传</span>';
            break;
        case 1:
            return '<span class="label label-warning">待审核</span>';
            break;
        case 2:
            return '<span class="label label-success">审核通过</span>';
            break;
        case 3:
            return '<span class="label label-danger">拒绝</span>';
            break;
    }
}

$this->title = '审核验证';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nickname',
            [
                'attribute' => 'car_certification_stage',
                'value' => function($v) {return status($v, 'car_certification_stage');},
                'format' => 'html'
            ],
            [
                'attribute' => 'avatar_certification_stage',
                'value' => function($v) {return status($v, 'avatar_certification_stage');},
                'format' => 'html'
            ],
            [
                'attribute' => 'id_certification_stage',
                'value' => function($v) {return status($v, 'id_certification_stage');},
                'format' => 'html'
            ],
            [
                'attribute' => 'video_certification_stage',
                'value' => function($v) {return status($v, 'video_certification_stage');},
                'format' => 'html'
            ],
            [
                'attribute' => 'unmakeup_certification_stage',
                'value' => function($v) {return status($v, 'unmakeup_certification_stage');},
                'format' => 'html'
            ],
            [
                'attribute' => 'part_certification_stage',
                'value' => function($v) {return status($v, 'part_certification_stage');},
                'format' => 'html'
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}']
        ],
    ]); ?>

</div>
