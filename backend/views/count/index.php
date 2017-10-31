<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\CountHtml;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'H5统计';
$this->params['breadcrumbs'][] = $this->title;
if ($na <> "") {
	$this->params['breadcrumbs'][] = $na;
}
?>
<div class="user-update">
    <div class="box">
        <div class="box-body">
        
        <div class="form-group field-config-config_key">
        <?php $form = ActiveForm::begin(); ?>
			<label class="control-label" for="config-config_key">H5活动名称：
			<select name="name" id="name">
				<?php foreach ($names as $name) {?>
					<option value="<?=$name?>" <?php if($na == $name){ echo 'selected="selected"';}?>><?=$name?></option>
				<?php } ?>
			</select></label>
		<?php ActiveForm::end(); ?>
		</div>

            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">实时访问统计：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">渠道</td><td style="width: 30%;">点击量</td><td style="width: 30%;">日期</td></tr>
				<?php if (count($data_all) > 0) {?>
				<?php foreach ($data_all as $row) {?>
					<tr>
						<td><?=$row['d']?><?php if(isset($dist_arr[$row['d']])){ echo "(".$dist_arr[$row['d']].")";}?></td>
						<td><?=$row['c']?></td>
						<td><?=$row['e']?></td>
					</tr>
				<?php } ?>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">实时下载统计：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">渠道</td><td style="width: 30%;">下载量</td><td style="width: 30%;">日期</td></tr>
				<?php if (count($down_all) > 0) {?>
				<?php foreach ($down_all as $row) {?>
					<tr>
						<td><?=$row['d']?><?php if(isset($dist_arr[$row['d']])){ echo "(".$dist_arr[$row['d']].")";}?></td>
						<td><?=$row['c']?></td>
						<td><?=$row['e']?></td>
					</tr>
				<?php } ?>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">每天充值成功次数：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">日期</td><td style="width: 30%;">充值成功次数</td><td style="width: 30%;"></td></tr>
				<?php if (count($diamond_order_all) > 0) {?>
				<?php foreach ($diamond_order_all as $row) {?>
					<tr>
						<td><?=$row['c']?></td>
						<td><?=$row['d']?></td>
						<td></td>
					</tr>
				<?php } ?>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">每天充值成功人数：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">日期</td><td style="width: 30%;">充值成功人数</td><td style="width: 30%;"></td></tr>
				<?php if (count($diamond_order_user) > 0) {?>
				<?php foreach ($diamond_order_user as $row) {?>
					<tr>
						<td><?=$row['d']?></td>
						<td><?=$row['e']?></td>
						<td></td>
					</tr>
				<?php } ?>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">每天充值总金额：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">日期</td><td style="width: 30%;">充值总金额</td><td style="width: 30%;"></td></tr>
				<?php if (count($diamond_order_rmb) > 0) {?>
				<?php foreach ($diamond_order_rmb as $row) {?>
					<tr>
						<td><?=$row['c']?></td>
						<td><?=$row['d']?></td>
						<td></td>
					</tr>
				<?php } ?>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">每天每个档次充值总次数：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">日期</td><td style="width: 30%;">充值档次</td><td style="width: 30%;">充值总次数</td></tr>
				<?php if (count($diamond_order_diamond_all) > 0) {?>
				<?php foreach ($diamond_order_diamond_all as $row) {?>
					<tr>
						<td><?=$row['d']?></td>
						<td><?=$row['e']?></td>
						<td><?=$row['c']?></td>
						<td></td>
					</tr>
				<?php } ?>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">每天每个档次充值总人数：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">日期</td><td style="width: 30%;">充值档次</td><td style="width: 30%;">充值总人数</td></tr>
				<?php if (count($diamond_order_diamond_user) > 0) {?>
				<?php foreach ($diamond_order_diamond_user as $row) {?>
					<tr>
						<td><?=$row['d']?></td>
						<td><?=$row['c']?></td>
						<td><?=$row['e']?></td>
						<td></td>
					</tr>
				<?php } ?>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
        </div>
	</div>
</div>
<script type="text/javascript">
jQuery("#name").change(function(){
	$("#w0").submit();
});
</script>