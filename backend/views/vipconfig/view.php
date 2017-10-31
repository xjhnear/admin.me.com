<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->vip;
$this->params['breadcrumbs'][] = ['label' => 'VIP等级配置', 'url' => ['index']];
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
            'vip',
    		'vip_grade',
            'grade_name',
            'credit_rating',
    		'experience',
    		'voteup_credit',
    		'dating_credit',
    		'open_photo',
    		'private_photo',
    		'match_credit',
    		'match_daily',
    		'friend_max_credit',
    		'dating',
    		'basic_filter',
    		'mid_filter',
    		'advanced_filter',
    		'gift_level',
    		'description',
        ],
    ]) ?>
    </div>
</div>
