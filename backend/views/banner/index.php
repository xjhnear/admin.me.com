<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '广告管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index box">
        <div class="box-header with-border">
            <?= Html::a('新增广告', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

    		'name',
    		'created',
    		'is_startpage',
    		[
    		'class' => 'yii\grid\ActionColumn', 'template' => '{startpage} {ios} {android} {view} {update} {delete}',
    		'buttons' => [
    		'startpage' => function($url, $dataProvider, $key) {
    		
    		return Html::a('设为启动页', ['setstargpage', 'id' => $key], ['class' => 'btn btn-primary',
    				]);
    		
    		},
    		'ios' => function($url, $dataProvider, $key) {

    		return Html::a('iOS图片', ['ios', 'id' => $key], ['class' => 'btn btn-primary',
    				]);
    		
    		},
    		'android' => function($url, $dataProvider, $key) {
    		
    		return Html::a('Android图片', ['android', 'id' => $key], ['class' => 'btn btn-primary',
    				]);
    		
    		},
    		]
    		]
        ],
    ]); ?>

</div>
