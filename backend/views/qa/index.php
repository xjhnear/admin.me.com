<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '说明文字';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index box">
        <div class="box-header with-border">
            <?= Html::a('新增说明', ['create'], ['class' => 'btn btn-primary']) ?>
        </div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

    		'xu',
            'question',
    		[
    		'label'=>'类型',
    		'attribute' => 'type',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['qa_type'][$dataProvider->type];
    		}
    		],
    		[
    		'label'=>'类别',
    		'attribute' => 'category',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['qa_category'][$dataProvider->category];
    		}
    		],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}'],
        ],
    ]); ?>

</div>
