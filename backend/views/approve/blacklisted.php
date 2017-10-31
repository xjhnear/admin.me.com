<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '处罚记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-update">

    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataBlacklisted,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
    		'user_id',
            'operator',
    		[
    		'label'=>'处罚类型',
    		'attribute' => 'option',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['blacklisted_option'][$dataProvider->option];
    		}
    		],
    		'reason',
            'created',

        ],
    ]); ?>
</div>
