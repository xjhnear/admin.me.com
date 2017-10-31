<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeeReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '约见投诉';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="see-report-index box">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'informer.nickname',
                'label' => '举报人'
            ],
            [
                'attribute' => 'beInformer.nickname',
                'label' => '被举报人'
            ],

    		[
    		'attribute' => 'category',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['see_report_category'][$dataProvider->category];
    		}
    		],
    		
    		[
    		'attribute' => 'status',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['see_report_status'][$dataProvider->status];
    		}
    		],


            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} '],
        ],
    ]); ?>

</div>
