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

function pic($v, $filed) {
	if(is_array($v->user->{$filed}) && !is_object($v->user->{$filed})) {
		$re = "";
		foreach($v->user->{$filed} as $k => $v) {
			$re .= Html::a(Html::img($v->path, ['height' => 100]), $v->path, ['target' => '_blank']);
		}
		return $re;
	} else {
		return Html::a(Html::img($v->user->{$filed}->path, ['height' => 100]), $v->user->{$filed}->path, ['target' => '_blank']);
	}

}

$this->title = '身材审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-index box">
    <div class="box-header">
        <?= Html::a('待审核', ['part'], ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-default">审核通过</a>
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
    		'attribute' => '身材预览',
    		'value' => function($v) {
    		return pic($v, 'partCertification');
    		},
    		'format' => 'html'
    		],
    		
            [
                'attribute' => '认证状态',
                'value' => function($v) {return status($v, 'part_certification_stage');},
                'format' => 'html'
            ],

            [
            'class' => 'yii\grid\ActionColumn', 'template' => '{view}', 
            'buttons' => [
            'view' => function ($url, $dataProvider, $key) {
                      return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $dataProvider->user_id, 'type'=>'part'] , ['title' => '查看'] );
                     },
            
            	]
            ]
        ],
    ]); ?>

</div>
