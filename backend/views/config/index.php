<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Config;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系统配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index box">
    <div class="box-header">
        <?= Html::a('新增配置', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('导入配置', ['import'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('导出配置', ['export'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

    		'title',
            //'config_key',
    		'config_value',
    		//'type',
    		
    		[
    		'attribute' => 'type',
    		'label'=>'类型',
    		'value'=>
    		function($model){
    			return  $model->type;   //主要通过此种方式实现
    		},
    		'filter' => Config::get_type(),     //此处我们可以将筛选项组合成key-value形式
    		],
    		
            'platform',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}'],
    		
        ],
    ]); ?>

</div>
