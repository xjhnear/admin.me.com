<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

function status($v) {
	switch($v) {
		case 0:
			return '<span class="label label-warning">待审核</span>';
			break;
		case 1:
			return '<span class="label label-success">审核通过</span>';
			break;
		case 2:
			return '<span class="label label-danger">拒绝</span>';
			break;
	}
}

function is_report($v) {
	if ($v > 0) {
		return '<span class="label label-danger">已被举报</span>';
	} else {
		return '<span class="label label-success">未被举报</span>';
	}
}

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '审核验证', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-view">

    <div class="box-header">
    	<?= Html::a('通过', ['photosuccess', 'id' => $model->id, 'back' => 'reportphoto'], ['class' => 'btn btn-primary']) ?>
    	<input type="button" class="btn btn-danger" onclick="disp_prompt(<?= $model->id ?>)" value="拒绝" />
    </div>
    
    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
			'user_id',
    		'user.nickname',
    		'report.from_user',
    		['label'=>'图片','attribute'=>'pic','format' => 'raw','value'=>Html::a(Html::img($model->photo, ["width" => 150]), $model->photo, ["target" => "_blank"])],
    		
    		'text',
//     		'latitude',
//     		'longitude',
    		'voteup',
    		['attribute' => 'is_approve','value'=>status($model->is_approve),'format' => 'html'],
    		'created',
            'updated',
    		
    		['label'=>'举报状态','attribute' => 'report.from_user','value'=>is_report(@$model->report->from_user),'format' => 'html'],
    		['label'=>'举报原因','value'=>Yii::$app->params['report_cat'][@$model->report->cat]],
        ],
    ]) ?>
    </div>

</div>

<script type="text/javascript">
function disp_prompt(id)
  {
  var name=prompt("被拒原因：","")
  if (name!=null && name!="")
  {
	  window.location.href = "/approve/photofail?id="+id+"&back=reportphoto&reason="+name;
  }
  else if (name=="")
  {
	  window.location.href = "/approve/photofail?id="+id+"&back=reportphoto";
  }
}
</script>
