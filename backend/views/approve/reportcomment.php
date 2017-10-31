<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '举报评论';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataReprot,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'from_user',
    		//'mobile',
            'to_user',
			'created',

            [
            'class' => 'yii\grid\ActionColumn', 'template' => '{view}', 
            'buttons' => [
            'view' => function ($url, $dataProvider, $key) {
                      return  Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['commentview', 'id' => $dataProvider->objectId] , ['title' => '查看'] );
                     },
            
            	]
            ]
        ],
    ]); ?>

</div>
