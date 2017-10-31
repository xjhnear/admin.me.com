<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiamondOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = '公开照片审核';
$this->params['breadcrumbs'][] = $this->title;
?>
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-header">
    	<?= Html::a('一键通过', ['opensuccessonekey', 'type' => 'open', 'page' => isset($_GET['page'])?$_GET['page']:1 ], ['class' => 'btn btn-primary',
    			'data' => [
                'confirm' => '确认一键通过本页宣言?',
                'method' => 'post',
            ],]) ?>
        <a class="btn btn-default">待审核</a>
        <?= Html::a('审核通过', ['openpass'], ['class' => 'btn btn-primary']) ?>
        
        <span style="float:right;"><b style="float: left;margin-top: 7px;">用户ID： </b><input type="text" class="form-control" name="UserUploadSearch[user_id]" style="width: 100px;float:right;"></span>
    </div>
    <?php ActiveForm::end(); ?>
    
<div class="diamond-order-index box">
	<div id="w0" class="box-body">
    		
<?php
ListView::begin([
    'dataProvider'=>$dataAll,
    'itemView'=>'_openlist',
    'layout'=>'{items}{pager}',
    'itemOptions'=>['class'=>'mydd_box'],
    'pager'=>[
        'maxButtonCount'=>10,
        'nextPageLabel'=>Yii::t('app','下一页'),
        'prevPageLabel'=>Yii::t('app','上一页'),
    ],
]);

ListView::end();
?>
	</div>
</div>

<script type="text/javascript">
function disp_prompt(id)
  {
  var name=prompt("被拒原因：","")
  if (name!=null && name!="")
  {
	  window.location.href = "/approve/openfail?id="+id+"&back=open&reason="+name;
  }
  else if (name=="")
  {
	  window.location.href = "/approve/openfail?id="+id+"&back=open";
  }
}
</script>
