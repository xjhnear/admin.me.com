<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DiamondOrder */

$this->title = $model->order_no;
$this->params['breadcrumbs'][] = ['label' => '充值记录', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-view box">

    <div class="box-header">
    	<?= Html::a('会员信息', ['user/view', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_no',
            'user.nickname',
    		'userextra.diamond',
            'diamond',
            'experience',
            'rmb',
    		['attribute' => 'status','value'=>Yii::$app->params['diamond_order_status'][$model->status]],
    		['attribute' => 'payment_method','value'=>Yii::$app->params['diamond_order_payment_method'][$model->payment_method]],
    		'trade_no',
    		'paid_time',
            'created',
            'updated',
        ],
    ]) ?>
    </div>
</div>
