<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->credit_rating;
$this->params['breadcrumbs'][] = ['label' => '信用等级配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view box">

    <div class="box-header">
        <?= Html::a('更新配置', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除配置', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除此配置项?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    
    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'credit_rating',
    		'vip',
            'credit_total',
            'credit_grade',
    		'grade_name',
    		'unmakup_certification',
    		'part_certification',
    		'match_vip',
    		'friend_max_credit',
    		'dating',
    		'dating_monthly',
    		'dating_diamond',
    		'dating_credit',
    		'concurrent_dating',
    		'basic_filter',
    		'mid_filter',
    		'advanced_filter',
    		'gift_level',
    		'description',
        ],
    ]) ?>
    </div>
</div>
