<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '宣言评论';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataComment,
    	'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'photo_id',
            'user_id',
			'text',
    		'reward',
            [
            'class' => 'yii\grid\ActionColumn', 'template' => '{view}', 
            'buttons' => [
            'view' => function ($url, $dataProvider, $key) {
                      return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['commentview', 'id' => $dataProvider->id] , ['title' => '查看'] );
                     },
            
            	]
            ]
        ],
    ]); ?>

</div>
