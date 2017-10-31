<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Feedback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '说明文字', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view box">
    <div class="box-header">
        <?= Html::a('更新说明', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除说明', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定删除此说明?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    

    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
    		'xu',
    		['label'=>'类型','value'=>Yii::$app->params['qa_type'][$model->type]],
    		['label'=>'类别','value'=>Yii::$app->params['qa_category'][$model->category]],
            'created',
            'updated',
        ],
    ]) ?>
    </div>
    
    <div class="box-body">
    <table class="table table-striped table-bordered detail-view">
	<tr><th>问题</th><td><?=$model->question?></td></tr>
	<tr><th>回答</th><td><?=$model->answer?></td></tr>
	</table>
	</div>
</div>
