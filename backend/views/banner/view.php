<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '广告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view box">
    <div class="box-header">
        <?= Html::a('更新广告', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('iOS图片', ['ios', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Android图片', ['android', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除广告', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除此广告?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if ($model->is_startpage == 1) {?>
        <?= Html::a('iOS启动页', ['startios', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Android启动页', ['startandroid', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->is_active == 0) {?>
        <?= Html::a('激活启动页', ['setactive', 'id' => $model->id, 'value' => '1'], ['class' => 'btn btn-primary']) ?>
        <?php }else{ ?>
        <?= Html::a('下架启动页', ['setactive', 'id' => $model->id, 'value' => '0'], ['class' => 'btn btn-primary']) ?>
    	<?php } ?>
    	<?php } ?>
    </div>
    

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
    		'photo',
    		'name',
    		'url',
    		'share_title',
    		'share_text',
    		'share_url',
    		'share_photo',
    		'start_time',
    		'end_time',
    		'position',
    		'start_photo',
    		'user_type',
            'created',
            'updated',
        ],
    ]) ?>
    </div>

</div>
