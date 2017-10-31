<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SeeReport */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '约见投诉', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="see-report-view box">

<?php if ($model->status == 'waiting') {?>
    <div class="box-header">
    	<?= Html::a('处理完成', ['updatestatus', 'id' => $model->id], ['class' => 'btn btn-primary',
    			'data' => [
                'confirm' => '确认处理完成?',
                'method' => 'post',
            ],]) ?>
    </div>
<?php } ?>
    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
    		['label'=>'举报人','value'=>$model->informer->nickname],
    		['label'=>'举报人电话','value'=>$model->informer->mobile],
    		['label'=>'被举报人','value'=>$model->beInformer->nickname],
    		['label'=>'被举报人电话','value'=>$model->beInformer->mobile],
            //'module_id',
    		['label'=>'举报类型','value'=>Yii::$app->params['see_report_category'][$model->category]],
            'message',
    		['label'=>'创建时间','value'=>date('Y-m-d H:i:s',$model->created_at)],
    		['label'=>'更新时间','value'=>date('Y-m-d H:i:s',$model->updated_at)],
    		['label'=>'处理状态','value'=>Yii::$app->params['see_report_status'][$model->status]],
        ],
    ]) ?>
    </div>
</div>
