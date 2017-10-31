<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiamondOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '宣言审核';
$this->params['breadcrumbs'][] = $this->title;


function status_all($v, $filed) {
	switch($v->{$filed}) {
		case 0:
			return '<span class="label label-warning">待审核</span>';
			break;
		case 1:
			return '<span class="label label-success">审核通过</span>';
			break;
		case 2:
			return '<span class="label label-danger">拒绝</span>';
			break;
	}
}

function is_report_all($v, $filed) {
	if ($v->report->{$filed} > 0) {
		return '<span class="label label-danger">已被举报</span>';
	} else {
		return '<span class="label label-success">未被举报</span>';
	}
}

?>
<div class="diamond-order-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
    		
    		[
    		'attribute' => 'photo',
    			'value' => function($v) {
    				return Html::img($v->photo, ["width" => 150]);
    			},
    			'format' => 'raw'
    		],
    		
    		
//             'user_id',
//             'user.nickname',

            [
                'attribute' => 'is_approve',
                'value' => function($v) {return status_all($v, 'is_approve');},
                'format' => 'html'
            ],
    		
            'created',
//     		'updated',
//             [
//                 'attribute' => 'report.from_user',
//                 'value' => function($v) {return is_report_all($v, 'from_user');},
//                 'format' => 'html'
//             ],
    		
    		[
    		'class' => 'yii\grid\ActionColumn', 'template' => '{view} {success} {fail}',
    		'buttons' => [
    		'view' => function ($url, $dataProvider, $key) {
    		return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['photoview', 'id' => $key ] , ['title' => '查看'] );
    		},
    		'success' => function($url, $dataProvider, $key) {
    		return Html::a('通过', ['photosuccess', 'id' => $key], ['class' => 'btn btn-primary']);
    		},
    		'fail' => function($url, $dataProvider, $key) {
    		return Html::a('拒绝', ['photofail', 'id' => $key], ['class' => 'btn btn-danger',
    				'data' => [
    				'confirm' => 'Are you sure you want to delete this item?',
    				'method' => 'post',
    				],
    				]);
    		},
    		]
    		]
        ],
    ]); ?>

</div>
