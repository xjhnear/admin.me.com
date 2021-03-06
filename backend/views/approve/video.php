<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

function status($v, $filed) {
    switch($v->user->{$filed}) {
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

$this->title = '视频审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-index box">
    <div class="box-header">
        <a class="btn btn-default">待审核</a>
        <?= Html::a('审核通过', ['videopass'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_id',
    		//'mobile',
            'user.nickname',

            [
                'attribute' => '认证状态',
                'value' => function($v) {return status($v, 'video_certification_stage');},
                'format' => 'html'
            ],
            

            [
            'class' => 'yii\grid\ActionColumn', 'template' => '{view}', 
            'buttons' => [
            'view' => function ($url, $dataProvider, $key) {
                      return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $dataProvider->user_id, 'type'=>'video'] , ['title' => '查看'] );
                     },
            
            	]
            ]
        ],
    ]); ?>

</div>
