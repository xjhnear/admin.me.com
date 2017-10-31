<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = '消费/收入记录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box">
	<div class="box-body">
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

	    <div class="controls form-group">
	    	<div class="input-prepend input-group">
	    	<span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span><input type="text" readonly style="width: 200px;margin-right: 10px;" name="reservation" id="reservation" class="form-control" value="<?php if (isset($_GET['t'])){echo $_GET['t'];}else{echo date("Y-m-d",time()-30*24*60*60)?> - <?=date("Y-m-d");}?>" /> 
	    	<input type="hidden" readonly name="uid" id="uid" value="<?=$uid?>" /> 
	    	<a href="javascript:void(0)" class="btn btn-primary search">查询</a>
	    	<a href="javascript:void(0)" class="btn btn-primary export">导出</a>
	    	</div>
	    </div>
	    
	<?php ActiveForm::end(); ?>
	</div>
	
    <?= GridView::widget([
        'options' => ['class'=>'box-body'],
        'dataProvider' => $dataProvider,
//         'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
    		[
    		'attribute' => 'type',
    		'value' => function ($dataProvider) {
    		return Yii::$app->params['diamond_history_type'][$dataProvider->type];
    		}
    		],
    		'from_user',
            'diamond',
            [
            'attribute' => 'status',
            'value' => function ($dataProvider) {
            return Yii::$app->params['diamond_history_status'][$dataProvider->status];
            }
            ],
            'created',
//            'password',

        ],
    ]); ?>
    
</div>
<script type="text/javascript">
jQuery(".search").click(function(){
	window.location.search = 'id=' + $('#uid').val() + '&t=' + $('#reservation').val();
});
jQuery(".export").click(function(){
	window.location.href = '/user/exportpointhistory?id=' + $('#uid').val() + '&t=' + $('#reservation').val();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
   $('#reservation').daterangepicker(null, function(start, end, label) {
     console.log(start.toISOString(), end.toISOString(), label);
   });
});
</script>