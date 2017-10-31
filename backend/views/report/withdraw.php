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
<tr><th>#</th><th>用户ID</th><th>用户昵称</th><th>钻石</th><th>金额</th><th>时间</th></tr>
</thead>
<tbody>
<?php 
$i = 1;
$d = 0;
$e = 0;
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
<?=$data->diamond?>
<?php $d += $data->diamond?>
</td>
<td>
<?=$data->rmb?>
<?php $e += $data->rmb?>
</td>
<td><?=$data->created?></td>
</tr>
<?php 
$i++;
} 
?>
<tr><th>合计</th><th></th><th></th><th><?=$d?></th><th><?=$e?></th><th></th></tr>
</tbody></table>

</div>
</div>
