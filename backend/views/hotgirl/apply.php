<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '圣诞红人支持名单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
    		'user.nickname',
    		'user.mobile',
    		'created',

    		['class' => 'yii\grid\ActionColumn', 'template' => ''],
        ],
    ]); ?>

</div>
