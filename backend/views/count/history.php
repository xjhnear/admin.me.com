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
				<label class="control-label" for="config-config_key">获得收益途径分布：</label>
				<input type="hidden" name="importok" value="1">
			</div>
			
				<table class="table table-striped table-bordered detail-view">
				<tr><td style="width: 40%;">获得收益途径</td><td style="width: 30%;">次数</td><td style="width: 30%;">总金额</td></tr>
				<?php if (count($dataProvider['diamond_history_type']) > 0) {?>
				<?php foreach ($dataProvider['diamond_history_type'] as $row) {?>
					<tr>
						<td><?=Yii::$app->params['diamond_history_type'][$row['c']]?></td>
						<td><?=$row['d']?></td>
						<td><?=$row['e']/10?></td>
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
