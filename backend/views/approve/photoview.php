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
    	<?= Html::a('通过', ['photosuccess', 'id' => $model->id, 'back' => 'photo'], ['class' => 'btn btn-primary']) ?>
        <input type="button" class="btn btn-danger" onclick="disp_prompt(<?= $model->id ?>)" value="拒绝" />
        <?php if(isset($model->video_url)) {?>
        <?= Html::a('设置封面', ['videoindex', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } ?>
    </div>
    
    <div class="box-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
			'user_id',
    		'user.nickname',
    		['label'=>$model->video_url?'视频':'图片','attribute'=>'pic','format' => 'raw','value'=>$model->video_url?'<video width="500" height="400" src="'.$model->video_url.'" controls="controls" autoplay="autoplay"></video>':Html::a(Html::img($model->photo, ["width" => 350]), $model->photo, ["target" => "_blank"])],
    		
    		'text',
//     		'latitude',
//     		'longitude',
    		'comment_number',
    		'reward_number',
    		'voteup',
    		['attribute' => 'is_approve','value'=>status($model->is_approve),'format' => 'html'],
    		'created',
            'updated',
    		
    		['attribute' => 'report.from_user','value'=>is_report(@$model->report->from_user),'format' => 'html'],
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
	  window.location.href = "/approve/photofail?id="+id+"&back=photo&reason="+name;
  }
  else if (name=="")
  {
	  window.location.href = "/approve/photofail?id="+id+"&back=photo";
  }
}
</script>
