<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '信用区间配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index box">
    <div class="box-header">
        <?= Html::a('新增配置', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

    		'grade_name',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}'],
    		
        ],
    ]); ?>

</div>
