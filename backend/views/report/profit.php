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
<tr><th>#</th><th>打赏</th><th>约见</th><th>私房照查看</th><th>素颜认证查看</th><th>身材认证查看</th><th>邀请好友收益</th><th>美女ID</th><th>老板ID</th><th>时间</th></tr>
</thead>
<tbody>
<?php 
$i = 1;
$b = 0;
$c = 0;
$d = 0;
$e = 0;
$f = 0;
$g = 0;
?>
<?php foreach ($dataProvider as $data) {
if ($data->created >= "2016-03-01 00:00:00") {
	$k = 1.2;
	$k2 = 0.2;
} else {
	$k = 1.15;
	$k2 = 0.15;
}
?>
<tr data-key="<?=$data->id?>">
<td><?=$i?></td>
<td>
<?php if ($data->type=="comment") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $b += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if (($data->type=="see" || $data->type=="dating" || $data->type=="dating_timeout" || $data->type=="dating_cancel") && ($data->status!="invited")) {?>
<?=round($data->diamond*$k2*0.1,2)?>
<?php $c += round($data->diamond*$k2*0.1,2)?>
<?php }?>
</td>
<td>
<?php if ($data->type=="private") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $d += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if ($data->type=="unmakeup") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $e += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if ($data->type=="part") {?>
<?=round($data->diamond*$k*0.1,2)?>
<?php $f += round($data->diamond*$k*0.1,2)?>
<?php }?>
</td>
<td>
<?php if ($data->status=="invited") {?>
<?=round($data->diamond*$k2*0.1,2)?>
<?php $g += round($data->diamond*$k2*0.1,2)?>
<?php }?>
</td>
<td>
<?=$data->user_id?>
<?php if (in_array($data->user_id, Yii::$app->params['test_user'])) {echo "(测)";}?>
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
<tr><th>合计</th><th><?=round($b,2)?></th><th><?=round($c,2)?></th><th><?=round($d,2)?></th><th><?=round($e,2)?></th><th><?=round($f,2)?></th><th><?=round($g,2)?></th><th></th><th></th><th></th></tr>
</tbody></table>


</div>
</div>
