<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '下载包管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view box">
    <div class="box-header">
        <?= Html::a('更新下载包', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除下载包', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除此下载包?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
    		'name',
    		'package',
    		'ver',
    		'type',
            'created',
            'updated',
        ],
    ]) ?>
    </div>

</div>
