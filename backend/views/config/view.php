<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->config_key;
$this->params['breadcrumbs'][] = ['label' => '系统配置', 'url' => ['index']];
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
    		'title',
            'config_key',
    		'config_value',
            'type',
            'platform',
        ],
    ]) ?>
    </div>
</div>
