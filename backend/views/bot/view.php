<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DiamondOrder */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => '机器人', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-view box">

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
    		['label'=>'性别','value'=>Yii::$app->params['user_utype'][$model->utype]],
    		'province',
            'created',
        ],
    ]) ?>
    </div>
</div>
