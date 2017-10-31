<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '充值记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'order_no',
    		[
    		'attribute' => 'payment_method',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['diamond_order_payment_method'][$dataProvider->payment_method];
    		}
    		],
            'diamond',
            'rmb',
            [
            'attribute' => 'status',
            'value' => function ($dataProvider) {
            return Yii::$app->params['diamond_order_status'][$dataProvider->status];
            }
            ],
    		'created',

        ],
    ]); ?>
    
</div>
