<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiamondOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '机器人';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-index box">
        <div class="box-header with-border">
            <?= Html::a('新增机器人', ['autoadd'], ['class' => 'btn btn-primary']) ?>
        </div>
        
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
    		'id',
            'user_id',
    		[
    		'attribute' => 'utype',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['user_utype'][$dataProvider->utype];
    		}
    		],
            'province',
//             'created',

            [
            'class' => 'yii\grid\ActionColumn', 'template' => '{view} {publish} {join}',
            'buttons' => [
            'view' => function($url, $dataProvider, $key) {
            return Html::a('详情', ['user/view', 'id' => $dataProvider->user_id], ['class' => 'btn btn-primary',
            		]);
            
            },
            'publish' => function($url, $dataProvider, $key) {
            return Html::a('发布约见', ['seepublish', 'id' => $key], ['class' => 'btn btn-primary',
            		]);
            
            },
            'join' => function($url, $dataProvider, $key) {
            return Html::a('参与约见', ['seejoin', 'id' => $key], ['class' => 'btn btn-primary',
            		]);
            
            },
            ]
            ]
        ],
    ]); ?>

</div>
