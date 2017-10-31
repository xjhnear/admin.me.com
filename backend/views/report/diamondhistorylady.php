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
<div class="summary">共<b><?=count($dataProvider)?></b>条数据.</div>
<table class="table table-striped table-bordered">
<thead>
<tr><th>#</th><th>用户ID</th><th>用户昵称</th><th>打赏</th><th>约见</th><th>私房照查看</th><th>素颜认证查看</th><th>身材认证查看</th><th>邀请好友收益</th><th>邀请百分比</th><th>来源用户ID</th><th>时间</th></tr>
</thead>
<tbody>
<?php 
$i = 1;
$d = 0;
$e = 0;
$f = 0;
$g = 0;
$h = 0;
$j = 0;
?>
<?php foreach ($dataProvider as $data) {
if ($data->created >= "2016-03-01 00:00:00") {
	$k = 0.8;
} else {
	$k = 0.85;
}
?>
<tr data-key="<?=$data->id?>">
<td><?=$i?></td>
<td>
<?=$data->user_id?>
<?php if (in_array($data->user_id, Yii::$app->params['test_user'])) {echo "(测)";}?>
</td>
<td><?=$data->user->nickname?></td>
<td>
<?php if ($data->type=="comment") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $d += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if (($data->type=="see" || $data->type=="dating" || $data->type=="dating_timeout" || $data->type=="dating_cancel") && ($data->status!="invited")) {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $e += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if ($data->type=="private") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $f += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if ($data->type=="unmakeup") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $g += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if ($data->type=="part") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $h += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if ($data->status=="invited") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $j += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>

</td>
<td>
<?=$data->from_user?>
<?php if (in_array($data->from_user, Yii::$app->params['test_user'])) {echo "(测)";}?>
</td>
<td><?=$data->created?></td>
</tr>
<?php 
$i++;
} 
?>
<tr><th>合计</th><th></th><th></th><th><?=round($d,2)?></th><th><?=round($e,2)?></th><th><?=round($f,2)?></th><th><?=round($g,2)?></th><th><?=round($h,2)?></th><th><?=round($j,2)?></th><th></th><th></th><th></th></tr>
</tbody></table>

</div>
</div>
