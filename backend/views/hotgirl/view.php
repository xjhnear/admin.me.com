<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '圣诞红人', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view box">

    <div class="box-header">
        <?= Html::a('更新圣诞红人', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除圣诞红人', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除此圣诞红人?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nickname',
    		['label'=>'图片','attribute'=>'photo','format' => 'raw','value'=>Html::a(Html::img($model->photo, ["width" => 150]), $model->photo, ["target" => "_blank"])],
    		
    		'ranking',
            'popularity',
            'applier',
    		'followee',
        ],
    ]) ?>
    </div>
</div>
