<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiamondOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '充值记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-index box">

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
            'user.nickname',
            'rmb',
            //'experience',
            // 'rmb',
            // 'status',
            // 'trade_no',
            // 'paid_time',
            'created',
            // 'updated',

            ['class' => \yii\grid\ActionColumn::className(), 'template' => '{view}'],
        ],
    ]); ?>

</div>
