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
				<label class="control-label" for="config-config_key">注册用户性别分布：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">性别</td><td style="width: 30%;">人数</td><td style="width: 30%;"></td></tr>
				<?php if (count($dataProvider['user_utype']) > 0) {?>
				<?php $su=0;?>
				<?php foreach ($dataProvider['user_utype'] as $row) {?>
					<?php $su+=$row['d'];?>
					<tr>
						<td>
						<?php switch ($row['c']) {
							case 1:
								echo "男";
								break;
							case 4:
								echo "女";
								break;
							default:
								echo "N/A";
						}
						?>
						</td>
						<td><?=$row['d']?></td>
						<td></td>
					</tr>
				<?php } ?>
					<tr>
						<td>合计</td>
						<td><?=$su?></td>
						<td></td>
					</tr>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
            <div class="form-group field-config-config_key">
				<label class="control-label" for="config-config_key">设备用户平台分布：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">平台</td><td style="width: 30%;">设备数</td><td style="width: 30%;"></td></tr>
				<?php if (count($dataProvider['device_os']) > 0) {?>
				<?php $sd=0;?>
				<?php foreach ($dataProvider['device_os'] as $row) {?>
					<?php $sd+=$row['d'];?>
					<tr>
						<td><?=$row['c']?:"N/A"?></td>
						<td><?=$row['d']?></td>
						<td></td>
					</tr>
				<?php } ?>
					<tr>
						<td>合计</td>
						<td><?=$sd?></td>
						<td></td>
					</tr>
				<?php } else {?>
					<tr><td colspan = "3" style="width: 100%;">暂无数据</td></tr>
				<?php } ?>
				</table>
				
			<div class="form-group field-config-config_key">	
			</div>
			
</div>
</div>
