<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DiamondOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */



$this->title = '宣言审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diamond-order-index box">
	<div id="w0" class="box-body">
    		
<?php
ListView::begin([
    'dataProvider'=>$dataReprot,
    'itemView'=>'_reportlist',
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
	  window.location.href = "/approve/photofail?id="+id+"&back=reportphoto&reason="+name;
  }
  else if (name=="")
  {
	  window.location.href = "/approve/photofail?id="+id+"&back=reportphoto";
  }
}
</script>
