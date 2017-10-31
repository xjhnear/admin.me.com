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
<tr><th>#</th><th>用户ID</th><th>用户昵称</th><th>打赏</th><th>约见</th><th>私房照查看</th><th>素颜认证查看</th><th>身材认证查看</th><th>时间</th></tr>
</thead>
<tbody>
<?php 
$i = 1;
$d = 0;
$e = 0;
$f = 0;
$g = 0;
$h = 0;
?>
<?php foreach ($dataProvider as $data) {?>
<tr data-key="<?=$data->id?>">
<td><?=$i?></td>
<td>
<?=$data->user_id?>
<?php if (in_array($data->user_id, Yii::$app->params['test_user'])) {echo "(测)";}?>
</td>
<td><?=$data->user->nickname?></td>
<td>
<?php if ($data->type=="comment") {?>
<?=$data->diamond*0.1?>
<?php $d += $data->diamond*0.1?>
<?php }?>
</td>
<td>
<?php if ($data->type=="see" || $data->type=="dating" || $data->type=="dating_timeout" || $data->type=="dating_cancel" || $data->type=="refund") {?>
<?=$data->diamond*0.1?>
<?php $e += $data->diamond*0.1?>
<?php }?>
</td>
<td>
<?php if ($data->type=="private") {?>
<?=$data->diamond*0.1?>
<?php $f += $data->diamond*0.1?>
<?php }?>
</td>
<td>
<?php if ($data->type=="unmakeup") {?>
<?=$data->diamond*0.1?>
<?php $g += $data->diamond*0.1?>
<?php }?>
</td>
<td>
<?php if ($data->type=="part") {?>
<?=$data->diamond*0.1?>
<?php $h += $data->diamond*0.1?>
<?php }?>
</td>
<td><?=$data->created?></td>
</tr>
<?php 
$i++;
} 
?>
<tr><th>合计</th><th></th><th></th><th><?=$d?></th><th><?=$e?></th><th><?=$f?></th><th><?=$g?></th><th><?=$h?></th><th></th></tr>
</tbody></table>

</div>
</div>
