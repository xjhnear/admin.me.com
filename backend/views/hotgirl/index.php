<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '圣诞红人';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index box">
<div class="box-body">
	<div class="form-group field-config-config_key">
		<label class="control-label" for="config-config_key">总投票人数：<?=$user_all?></label> 
		<label style="padding-left: 50px;" class="control-label" for="config-config_key">总投票次数：<?=$count_all?></label>
	</div>
</div>			
    <div class="box-header">
        <?= Html::a('新增圣诞红人', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
    		'nickname',
    		'popularity',
    		
    		[
    		'class' => 'yii\grid\ActionColumn', 'template' => '{success} {view} {update} {delete}',
    		'buttons' => [
    		'success' => function($url, $dataProvider, $key) {

    		return Html::a('支持名单', ['apply', 'id' => $key], ['class' => 'btn btn-primary',
    				'data' => [
    				'method' => 'post',
    				],
    				]);
    		
    		},
    		]
    		]
    		
        ],
    ]); ?>

</div>
