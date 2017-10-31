<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->diamond;
$this->params['breadcrumbs'][] = ['label' => '钻石充值配置', 'url' => ['index']];
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
    		'diamond',
            'rmb',
    		'experience',
            'text',
            'first_text',
    		'first_experience',
        ],
    ]) ?>
    </div>
</div>
