<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\widgets\ListView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiamondOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = '情人节审核';
$this->params['breadcrumbs'][] = $this->title;
?>
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="box-header">
    	<?= Html::a('一键通过', ['flowersuccessonekey', 'type' => 'photo', 'page' => isset($_GET['page'])?$_GET['page']:1 ], ['class' => 'btn btn-primary',
    			'data' => [
                'confirm' => '确认一键通过本页?',
                'method' => 'post',
            ],]) ?>
        <span style="float:right;"><b style="float: left;margin-top: 7px;">用户ID： </b><input type="text" class="form-control" name="PhotoSearch[user_id]" style="width: 100px;float:right;"></span>
    </div>
    <?php ActiveForm::end(); ?>
    
<div class="diamond-order-index box">
	<div id="w0" class="box-body">
    		
<?php
ListView::begin([
    'dataProvider'=>$dataAll,
    'itemView'=>'_flowerlist',
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
	  window.location.href = "/approve/flowerfail?id="+id+"&back=flower&reason="+name;
  }
  else if (name=="")
  {
	  window.location.href = "/approve/flowerfail?id="+id+"&back=flower";
  }
}
</script>
