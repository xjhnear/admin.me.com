<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '下载包管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index box">
        <div class="box-header with-border">
            <?= Html::a('新增下载包', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

    		'name',
            'ver',
    		'type',
    		'updated',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}'],
        ],
    ]); ?>

</div>
