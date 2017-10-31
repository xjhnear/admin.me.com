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
<tr><th>#</th><th>用户ID</th><th>用户昵称</th><th>支付方式</th><th>下单时间</th><th>充值钻石</th><th>充值人民币</th></tr>
</thead>
<tbody>
<?php 
$i = 1;
$f = 0;
$g = 0;
?>
<?php foreach ($dataProvider as $data) {?>
<tr data-key="<?=$data->id?>">
<td><?=$i?></td>
<td>
<?=$data->user_id?>
<?php if (in_array($data->user_id, Yii::$app->params['test_user'])) {echo "(测)";}?>
</td>
<td><?=$data->user->nickname?></td>
<td><?=Yii::$app->params['diamond_order_payment_method'][$data->payment_method]?></td>
<td><?=$data->created?></td>
<td>
<?=$data->diamond?>
<?php $f += $data->diamond?>
</td>
<td>
<?=$data->rmb?>
<?php $g += $data->rmb?>
</td>
</tr>
<?php 
$i++;
} 
?>
<tr><th>合计</th><th></th><th></th><th></th><th></th><th><?=$f?></th><th><?=$g?></th></tr>
</tbody></table>

</div>
</div>
