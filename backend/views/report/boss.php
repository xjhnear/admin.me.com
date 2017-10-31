<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '老板报表';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index box">
	<div class="box-body">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

	    <div class="controls form-group">
	    	<div class="input-prepend input-group">
	    	<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" readonly style="width: 200px;margin-right: 10px;" name="reservation" id="reservation" class="form-control" value="<?php if (isset($_GET['t'])){echo $_GET['t'];}else{echo date("Y-m-d",time()-30*24*60*60)?> - <?=date("Y-m-d");}?>" /> 
	    	<a href="javascript:void(0)" class="btn btn-primary search">查询</a>
	    	<a href="javascript:void(0)" class="btn btn-primary export">导出</a>
	    	</div>
	    </div>
	    
	<?php ActiveForm::end(); ?>
	<div class="footer-container" style="border-top:0px solid #999; height: 40px;"></div>
	<?= Tabs::widget([
	    'items' => [
	        [
	            'label' => '充值',
				'content' => $this->render('diamondorder',['dataProvider'=>$dataDiamondOrder]),
				'headerOptions' => ["id" => 'tab1'],
				'options' => ['id' => 'topic1'],
				'active' => true
	        ],
	        [
	            'label' => '消费',
				'content' => $this->render('diamondhistory',['dataProvider'=>$dataDiamondhistory]),
				'headerOptions' => ["id" => 'tab2'],
				'options' => ['id' => 'topic2'],
	        ],
	    ],
	]);
	
	?>

    </div>
    
    <div class="footer-container" style="border-top:0px solid #999; height: 40px;"></div>


</div>
<script type="text/javascript">
jQuery(".search").click(function(){
	window.location.search = 't=' + $('#reservation').val();
});
jQuery(".export").click(function(){
	window.location.pathname = '/report/exportboss?t=' + $('#reservation').val();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
   $('#reservation').daterangepicker(null, function(start, end, label) {
     console.log(start.toISOString(), end.toISOString(), label);
   });
});
</script>