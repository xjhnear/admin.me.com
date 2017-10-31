<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '统计报表';
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
	            'label' => '用户情况分析',
				'content' => $this->render('user',['dataProvider'=>$data_user]),
				'headerOptions' => ["id" => 'tab4'],
				'options' => ['id' => 'topic4'],
				'active' => true
	        ],
	        [
	            'label' => '留存流失分析',
				'content' => $this->render('table',['dataProvider'=>$data]),
				'headerOptions' => ["id" => 'tab1'],
				'options' => ['id' => 'topic1'],
	        ],
	        [
	            'label' => '新增用户分时',
				'content' => $this->render('time',['dataProvider'=>$userdata]),
				'headerOptions' => ["id" => 'tab2'],
				'options' => ['id' => 'topic2'],
	        ],
	        [
	            'label' => '充值情况分析',
				'content' => $this->render('diamond',['dataProvider'=>$data_diamond]),
				'headerOptions' => ["id" => 'tab3'],
				'options' => ['id' => 'topic3'],
	        ],
	        [
	            'label' => '收益情况分析',
				'content' => $this->render('history',['dataProvider'=>$data_history]),
				'headerOptions' => ["id" => 'tab5'],
				'options' => ['id' => 'topic5'],
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
	window.location = '/count/exportreport?t=' + $('#reservation').val();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
   $('#reservation').daterangepicker(null, function(start, end, label) {
     console.log(start.toISOString(), end.toISOString(), label);
   });
});
</script>