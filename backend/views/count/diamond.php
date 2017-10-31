<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */


?>
<div class="user-index box">
<div id="w1" class="box-body">
	
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">每天充值成功次数：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">日期</td><td style="width: 30%;">充值成功次数</td><td style="width: 30%;"></td></tr>
				<?php if (count($dataProvider['diamond_order_all']) > 0) {?>
				<?php foreach ($dataProvider['diamond_order_all'] as $row) {?>
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
				<?php if (count($dataProvider['diamond_order_user']) > 0) {?>
				<?php foreach ($dataProvider['diamond_order_user'] as $row) {?>
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
				<?php if (count($dataProvider['diamond_order_rmb']) > 0) {?>
				<?php foreach ($dataProvider['diamond_order_rmb'] as $row) {?>
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
				<tr><td style="width: 40%;">日期</td><td style="width: 20%;">充值档次</td><td style="width: 20%;">充值总次数</td><td style="width: 20%;">充值总金额</td></tr>
				<?php if (count($dataProvider['diamond_order_diamond_all']) > 0) {?>
				<?php foreach ($dataProvider['diamond_order_diamond_all'] as $row) {?>
					<tr>
						<td><?=$row['d']?></td>
						<td><?=$row['e']?></td>
						<td><?=$row['c']?></td>
						<td><?=($row['e']*$row['c'])/10?></td>
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
				<?php if (count($dataProvider['diamond_order_diamond_user']) > 0) {?>
				<?php foreach ($dataProvider['diamond_order_diamond_user'] as $row) {?>
					<tr>
						<td><?=$row['d']?></td>
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

</div>
</div>
