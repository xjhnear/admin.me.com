<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '提现记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
				
    		'account_no',
    		'diamond',
    		'account_name',
            //'operator',
    		[
    		'attribute' => 'status',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['withdraw_status'][$dataProvider->status];
    		}
    		],
            'created',
            //'paid_time',

    		[
    		'class' => 'yii\grid\ActionColumn', 'template' => '{success} ',
    		'buttons' => [
    		'success' => function($url, $dataProvider, $key) {
    		if ($dataProvider->status == 'pending') {
    			return Html::a('通过', ['withdrawsuccess', 'id' => $key, 'uid' => $dataProvider->user_id], ['class' => 'btn btn-primary',
    					'data' => [
    					'confirm' => '确认通过此提现?',
    					'method' => 'post',
    					],
    					]);
    		}
    		},
    		'fail' => function($url, $dataProvider, $key) {
    		return Html::a('拒绝', ['withdrawfail', 'id' => $key, 'uid' => $dataProvider->user_id], ['class' => 'btn btn-danger',
    				'data' => [
    				'confirm' => '确认拒绝此提现?',
    				'method' => 'post',
    				],
    				]);
    		},
    		]
    		]
        ],
    ]); ?>
    
</div>
