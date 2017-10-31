<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\See */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '约见管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="see-view box">


    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.nickname',
            'dianping.name',
            //'obj_sex',
    		'see_time',
    		['label'=>'约见状态','value'=>Yii::$app->params['see_status'][$model->status]],
    		'release_long',
            'message',
    		'created',
    		'updated',
        ],
    ]) ?>
    
    <p style="margin-top: 20px"><strong>参与者</strong></p>
    <?php
        foreach($model->seeJoin as $k => $v) {
            echo DetailView::widget([
                'model' => $v,
                'attributes' => [
                    'user_id',
            		'user.nickname',
            		['label'=>'约见状态','value'=>Yii::$app->params['seejoin_status'][$v->status]],
            		//['label'=>'是否到达','value'=>Yii::$app->params['seejoin_is_arrive'][$v->is_arrive]],
                    'longitude',
                    'latitude',
                ],
    			'template' => '<tr><th style="width:36%;">{label}</th><td>{value}</td></tr>',
    			'options' => ['class' => 'table table-striped table-bordered detail-view'],
            ]);
        }

    ?>

    </div>
</div>
