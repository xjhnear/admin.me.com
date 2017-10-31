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
<tr><th>#</th><th>日期</th><th>新增用户</th><th>登陆用户</th><th>老用户登陆</th><th>次日留存</th><th>七日留存</th><th>月留存</th><th>注册成功率</th><th>启动页流失率</th><th>手机号界面流失率</th><th>验证码界面流失率</th><th>密码界面流失率</th><th>账号类型界面流失率</th><th>昵称界面流失率</th><th>基本信息界面流失率</th></tr>
</thead>
<tbody>
<?php 
$i = 1;
?>
<?php foreach ($dataProvider as $data) {?>
<tr data-key="<?=$data->id?>">
<td><?=$i?></td>
<td>
<?=$data->daytime?>
</td>
<td>
<?=$data->user_today?>
</td>
<td>
<?=($data->user_today + $data->login_old_today)?>
</td>
<td>
<?=$data->login_old_today?>
</td>

<td>
<?php if($data->user_2day>0) {?>
<?php echo round(($data->login_old_2d/$data->user_2day)*100).'% ('.$data->login_old_2d.'/'.$data->user_2day.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->user_7day>0) {?>
<?php echo round(($data->login_old_7d/$data->user_7day)*100).'% ('.$data->login_old_7d.'/'.$data->user_7day.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->user_30day>0) {?>
<?php echo round(($data->login_old_30d/$data->user_30day)*100).'% ('.$data->login_old_30d.'/'.$data->user_30day.')';?>
<?php }else{echo "N/A";}?>
</td>

<td>
<?php if($data->start_udid>0) {?>
<?php echo round(($data->user_today/$data->start_udid)*100).'% ('.$data->user_today.'/'.$data->start_udid.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->start_udid>0) {?>
<?php echo round((($data->start_udid-$data->send_udid)/$data->start_udid)*100).'% ('.$data->start_udid.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->start_udid>0) {?>
<?php echo round((($data->send_udid-$data->verify_udid)/$data->start_udid)*100).'% ('.$data->send_udid.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->start_udid>0) {?>
<?php echo round((($data->verify_udid-$data->password_udid)/$data->start_udid)*100).'% ('.$data->verify_udid.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->start_udid>0) {?>
<?php echo round((($data->password_udid-$data->utype_udid)/$data->start_udid)*100).'% ('.$data->password_udid.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->start_udid>0) {?>
<?php echo round((($data->utype_udid-$data->nickname_udid)/$data->start_udid)*100).'% ('.$data->utype_udid.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->start_udid>0) {?>
<?php echo round((($data->nickname_udid-$data->birthday_udid)/$data->start_udid)*100).'% ('.$data->nickname_udid.')';?>
<?php }else{echo "N/A";}?>
</td>
<td>
<?php if($data->start_udid>0) {?>
<?php echo round((($data->birthday_udid-$data->photo_today)/$data->start_udid)*100).'% ('.$data->birthday_udid.')';?>
<?php }else{echo "N/A";}?>
</td>

</tr>
<?php 
$i++;
} 
?>
</tbody></table>

</div>
</div>
